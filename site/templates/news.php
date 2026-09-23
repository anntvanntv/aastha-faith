<?php namespace ProcessWire;

$q = trim((string) $input->get->text('q'));
$children = $page->children("sort=-date");

$newsCard = function ($story) use ($config) {
    ?>
    <div class="news-card" data-date="<?= (int) $story->date ?>">
        <div class="ncard-picture bgw800">
            <?php if ($story->image): ?>
                <img src="<?= $story->image->url ?>" alt="<?= $story->title ?>">
            <?php endif; ?>
        </div>
        <div class="ncard-content">
            <div class="title-content">
                <h5 class="date" style="text-transform: uppercase;"><?= $story->date ? strtoupper(date("F j, Y", $story->date)) : '' ?></h5>
                <h4><?= $story->title ?></h4>
                <div class="clamp-wrap">
                    <p class="clamp-text clamp-4"><?= strip_tags($story->body) ?></p>
                </div>
            </div>
            <div class="btn-content">
                <a href="<?= $story->url ?>" class="btn emptyblack">
                    Read more
                    <img src="<?= $config->urls->templates ?>icons/arrow_forward.png" alt="icon_arrow">
                </a>
            </div>
        </div>
    </div>
    <?php
};

if ($q !== '') {
    $results = $page->children("sort=-date,title|body%=" . $sanitizer->selectorValue($q));
    $visibleNews = $results;
    $extraBatches = [];
} else {
    $results = null;
    $visibleNews = $children->slice(0, 6);
    $extraBatches = array_chunk(iterator_to_array($children->slice(6)), 6);
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
            <a href="<?= $config->urls->admin ?>page/add/?parent_id=<?= $page->id ?>" class="btn add-story-btn">
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
