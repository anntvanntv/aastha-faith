<?php namespace ProcessWire;

$segment = $input->urlSegment1;
$segment = $segment ? preg_replace('/-+/', '-', $sanitizer->pageName($segment)) : '';
$newsUrl = $page->url;

// detail view: /news/{slug}/ resolves an album_card row by slug
if ($segment) {
    $onenewsItem = null;
    foreach ($page->album_card as $row) {
        $rowSlug = preg_replace('/-+/', '-', $sanitizer->pageName($row->album_card_title));
        if ($rowSlug === $segment) { $onenewsItem = $row; break; }
    }
    if ($onenewsItem) {
        include('./onenews.php');
        // segment-rendered pages load news.js via _main — include onenews.js too
        echo '<script src="' . $config->urls->templates . 'scripts/onenews.js"></script>';
        return;
    }
    throw new Wire404Exception();
}

$q = trim((string) $input->get->text('q'));

// normalize album_card rows and onenews children into a single shape
$items = [];
foreach ($page->album_card as $row) {
    $items[] = [
        'title' => $row->album_card_title,
        'date' => $row->album_card_date,
        'text' => $row->album_card_text,
        'img' => $row->album_card_image,
        'link' => null,
        'slug' => preg_replace('/-+/', '-', $sanitizer->pageName($row->album_card_title)),
    ];
}
if (!count($items)) {
    // fallback: onenews children (pre-migration / prod backup)
    foreach ($page->children('sort=-date') as $c) {
        $items[] = [
            'title' => $c->title,
            'date' => $c->date,
            'text' => $c->body,
            'img' => $c->image,
            'link' => $c->url,
            'slug' => null,
        ];
    }
}
usort($items, function ($a, $b) { return $b['date'] - $a['date']; });

$newsCard = function ($item) use ($config, $newsUrl) {
    $cardImg = $item['img'];
    if ($cardImg instanceof Pageimages) {
        $cardImg = count($cardImg) ? $cardImg->first() : null;
    }
    $href = $item['link'] ?: $newsUrl . $item['slug'] . '/';
    ?>
    <div class="news-card" data-date="<?= (int) $item['date'] ?>">
        <div class="ncard-picture bgw800">
            <?php if ($cardImg): ?>
                <img src="<?= $cardImg->url ?>" alt="<?= $item['title'] ?>">
            <?php endif; ?>
        </div>
        <div class="ncard-content">
            <div class="title-content">
                <h5 class="date" style="text-transform: uppercase;"><?= $item['date'] ? strtoupper(date("F j, Y", $item['date'])) : '' ?></h5>
                <h4><?= $item['title'] ?></h4>
                <div class="clamp-wrap">
                    <p class="clamp-text clamp-4"><?= strip_tags($item['text']) ?></p>
                </div>
            </div>
            <div class="btn-content">
                <a href="<?= $href ?>" class="btn emptyblack">
                    Read more
                    <img src="<?= $config->urls->templates ?>icons/arrow_forward.png" alt="icon_arrow">
                </a>
            </div>
        </div>
    </div>
    <?php
};

if ($q !== '') {
    $needle = strtolower($q);
    $results = array_values(array_filter($items, function ($item) use ($needle) {
        return strpos(strtolower($item['title'] . ' ' . strip_tags($item['text'])), $needle) !== false;
    }));
    $visibleNews = $results;
    $extraBatches = [];
} else {
    $results = null;
    $visibleNews = array_slice($items, 0, 6);
    $extraBatches = array_chunk(array_slice($items, 6), 6);
}
?>

<div id="content">
<header>
<?php include('./_nav.php'); ?>
        <section class="title-stories" data-nav-color="dark">
            <div class="eyebrow">
                <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                <h5>EXPLORE</h5>
            </div>
            <h1 edit="title"><?= $page->title ?></h1>
        </section>
    </header>

    <div class="news-tools">
        <form class="news-search" method="get" action="">
            <input type="search" name="q" value="<?= $sanitizer->entities($q) ?>" placeholder="Search news…">
            <button class="btn" type="submit">Search</button>
        </form>
        <div class="news-filters">
            <a class="news-all<?= $results === null ? ' active' : '' ?>" href="<?= $page->url ?>" data-range="all">All</a>
            <button type="button" class="news-filter" data-range="today">Today</button>
            <button type="button" class="news-filter" data-range="week">This Week</button>
            <button type="button" class="news-filter" data-range="month">This Month</button>
            <input type="date" class="news-date news-date-from" aria-label="From date">
            <input type="date" class="news-date news-date-to" aria-label="To date">
        </div>
        <?php if ($results !== null): ?>
            <p class="news-results-meta">
                <?= count($results) ?> result<?= count($results) === 1 ? '' : 's' ?> for &ldquo;<?= $sanitizer->entities($q) ?>&rdquo;
            </p>
        <?php endif; ?>
        <?php if($user->isLoggedin()): ?>
            <a href="<?= $config->urls->admin ?>page/edit/?id=<?= $page->id ?>" class="btn add-story-btn">
                Add News
            </a>
        <?php endif; ?>
    </div>

    <section class="container">
        <?php foreach($visibleNews as $row): ?>
            <?php $newsCard($row); ?>
        <?php endforeach; ?>
    </section>

    <?php foreach ($extraBatches as $batch): ?>
    <div class="more-cards">
        <section class="container">
            <?php foreach($batch as $row): ?>
                <?php $newsCard($row); ?>
            <?php endforeach; ?>
        </section>
    </div>
    <?php endforeach; ?>

    <?php if (count($extraBatches)): ?>
    <button class="expand-cards-btn" id="expandCardsBtn">
        <span class="expand-cards-label" id="expandCardsLabel">See More</span>
        <svg class="expand-cards-arrow" width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 1L7 7L13 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    <?php endif; ?>

    <?php include('./_footer.php'); ?>
</div>
