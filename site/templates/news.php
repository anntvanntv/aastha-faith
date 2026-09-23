<?php namespace ProcessWire;

$q = trim((string) $input->get->text('q'));
$items = $page->news_card;
$segment = $input->urlSegment1;

// sort repeater items by date desc (newest first)
$sorted = [];
foreach ($items as $item) {
    $sorted[] = $item;
}
usort($sorted, function ($a, $b) {
    return $b->news_card_date - $a->news_card_date;
});

$newsUrl = wire('pages')->get('/news/')->url;
$newsCard = function ($item) use ($config, $sanitizer, $newsUrl) {
    $slug = $sanitizer->pageName($item->news_card_title);
    ?>
    <div class="news-card" data-date="<?= (int) $item->news_card_date ?>">
        <div class="ncard-picture bgw800">
            <?php if ($item->news_card_image): ?>
                <img src="<?= $item->news_card_image->url ?>" alt="<?= $item->news_card_title ?>">
            <?php endif; ?>
        </div>
        <div class="ncard-content">
            <div class="title-content">
                <h5 class="date" style="text-transform: uppercase;"><?= $item->news_card_date ? strtoupper(date("F j, Y", $item->news_card_date)) : '' ?></h5>
                <h4><?= $item->news_card_title ?></h4>
                <div class="clamp-wrap">
                    <p class="clamp-text clamp-4"><?= strip_tags($item->news_card_body) ?></p>
                </div>
            </div>
            <div class="btn-content">
                <a href="<?= $newsUrl . $slug ?>/" class="btn emptyblack">
                    Read more
                    <img src="<?= $config->urls->templates ?>icons/arrow_forward.png" alt="icon_arrow">
                </a>
            </div>
        </div>
    </div>
    <?php
};

if ($segment) {
    // detail view: find matching repeater item by slug
    $item = null;
    foreach ($sorted as $i) {
        if ($sanitizer->pageName($i->news_card_title) === $segment) {
            $item = $i;
            break;
        }
    }
    if ($item) {
        $page->of(false);
        $page->title = $item->news_card_title;
        $page->body = $item->news_card_body;
        $page->date = $item->news_card_date;
        $page->image = $item->news_card_image;
        // render detail via onenews template
        include('./onenews.php');
        return;
    }
}

if ($q !== '') {
    $results = [];
    foreach ($sorted as $item) {
        $hay = strtolower($item->news_card_title . ' ' . $item->news_card_body);
        if (strpos($hay, strtolower($q)) !== false) {
            $results[] = $item;
        }
    }
    $visibleNews = $results;
    $extraBatches = [];
} else {
    $results = null;
    $visibleNews = array_slice($sorted, 0, 6);
    $extraBatches = array_chunk(array_slice($sorted, 6), 6);
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
        <?php foreach($visibleNews as $story): ?>
            <?php $newsCard($story); ?>
        <?php endforeach; ?>
    </section>

    <?php foreach ($extraBatches as $batch): ?>
    <div class="more-cards">
        <section class="container">
            <?php foreach($batch as $story): ?>
                <?php $newsCard($story); ?>
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
