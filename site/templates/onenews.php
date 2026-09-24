<?php
namespace ProcessWire;

// $onenewsItem = album_card row when included from news.php; null for onenews pages
if (isset($onenewsItem) && $onenewsItem) {
    $title = $onenewsItem->album_card_title;
    $date = $onenewsItem->album_card_date;
    $body = $onenewsItem->album_card_text;
    $image = $onenewsItem->album_card_image;
} else {
    $title = $page->title;
    $date = $page->date;
    $body = $page->getUnformatted('body');
    $image = $page->image;
}
if ($image instanceof Pageimages) {
    $image = count($image) ? $image->first() : null;
}

// sidebar: all news items (title + date only), newest first
$newsPg = $pages->get('/news/');
$sideItems = [];
if ($newsPg->id) {
    foreach ($newsPg->album_card as $row) {
        $sideItems[] = [
            'title' => $row->album_card_title,
            'date' => $row->album_card_date,
            'link' => $newsPg->url . preg_replace('/-+/', '-', $sanitizer->pageName($row->album_card_title)) . '/',
        ];
    }
    if (!count($sideItems)) {
        foreach ($newsPg->children('sort=-date') as $c) {
            $sideItems[] = ['title' => $c->title, 'date' => $c->date, 'link' => $c->url];
        }
    }
    usort($sideItems, function ($a, $b) { return $b['date'] - $a['date']; });
}
$currentHref = $input->urlSegment1
    ? $newsPg->url . preg_replace('/-+/', '-', $sanitizer->pageName($input->urlSegment1)) . '/'
    : $page->url;

?>


<div id="content" class="onenews">

    <header class="onestory">
        <?php include('./_nav.php'); ?>
    </header>

    <section class="one-story-content" data-nav-color="dark">
        <div class="title-one-story">
            <div class="one-story-nav">
                <a class="btn white" href="/#field"><svg width="16" height="16"
                        viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 7H3.83L9.42 1.41L8 0L0 8L8 16L9.41 14.59L3.83 9H16V7Z" fill="currentColor" />
                    </svg>
                    Back to Latest News</a>
                <button class="ones-button btn" id="share-story">
                    Share
                    <div class="share">
                        <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 9.38667C9.49333 9.38667 9.04 9.58667 8.69333 9.9L3.94 7.13333C3.97333 6.98 4 6.82667 4 6.66667C4 6.50667 3.97333 6.35333 3.94 6.2L8.64 3.46C9 3.79333 9.47333 4 10 4C11.1067 4 12 3.10667 12 2C12 0.893333 11.1067 0 10 0C8.89333 0 8 0.893333 8 2C8 2.16 8.02667 2.31333 8.06 2.46667L3.36 5.20667C3 4.87333 2.52667 4.66667 2 4.66667C0.893333 4.66667 0 5.56 0 6.66667C0 7.77333 0.893333 8.66667 2 8.66667C2.52667 8.66667 3 8.46 3.36 8.12667L8.10667 10.9C8.07333 11.04 8.05333 11.1867 8.05333 11.3333C8.05333 12.4067 8.92667 13.28 10 13.28C11.0733 13.28 11.9467 12.4067 11.9467 11.3333C11.9467 10.26 11.0733 9.38667 10 9.38667ZM10 1.33333C10.3667 1.33333 10.6667 1.63333 10.6667 2C10.6667 2.36667 10.3667 2.66667 10 2.66667C9.63333 2.66667 9.33333 2.36667 9.33333 2C9.33333 1.63333 9.33333 1.33333 10 1.33333ZM2 7.33333C1.63333 7.33333 1.33333 7.03333 1.33333 6.66667C1.33333 6.3 1.63333 6 2 6C2.36667 6 2.66667 6.3 2.66667 6.66667C2.66667 7.03333 2.36667 7.33333 2 7.33333ZM10 12.0133C9.63333 12.0133 9.33333 11.7133 9.33333 11.3467C9.33333 10.98 9.63333 10.68 10 10.68C10.3667 10.68 10.6667 10.98 10.6667 11.3467C10.6667 11.7133 10.3667 12.0133 10 12.0133Z"
                                fill="currentColor" />
                        </svg>
                    </div>
                </button>
                <div class="share-dialog hidden-story" id="share-dialog">
                    <h4>Share news</h4>
                    <div class="icon" id="close-dialog"><img src="<?= $config->urls->templates ?>icons/close-dark.svg"
                            alt=""></div>
                    <div class="box-url">
                        <input id="share-url" type="text" readonly></input>
                        <button class="btn" id="copy-link">
                            copy link
                        </button>
                    </div>
                    <div class="share-options">
                        <div id="share-whatsapp"><img src="<?= $config->urls->templates ?>icons/icon-whatsapp.svg"
                                alt="icon"></div>
                        <div id="share-facebook"><img src="<?= $config->urls->templates ?>icons/facebook.svg"
                                alt="icon"></div>
                        <div id="share-linkedin"><img src="<?= $config->urls->templates ?>icons/linkedin.svg"
                                alt="icon"></div>
                    </div>
                </div>
            </div>

            <h2><?= $title ?></h2>
            <div class="fr-sb">
                <div class="programme-title">
                    <h5 style="text-transform: uppercase;">
                        <?= $date ? strtoupper(date("F j, Y", $date)) : "" ?>
                    </h5>
                </div>
            </div>
        </div>
        <div class="description-one-story">
            <div class="one-story-main">
                <div class="text-one-story">
                    <?php foreach (preg_split('/\R\s*\R/', trim($body)) as $para): ?>
                        <?php if (trim($para) === '') continue; ?>
                        <p><?= nl2br($sanitizer->entities(trim($para))) ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="photo-onestory">
                    <?php if ($image): ?>
                        <img class="one-story-foto" src="<?= $image->url ?>" alt="<?= $title ?>">
                    <?php endif; ?>
                </div>
            </div>
            <aside class="news-side">
                <h5 class="news-side-heading">More News</h5>
                <div class="news-tools">
                    <form class="news-search" method="get" action="">
                        <input type="search" name="q" placeholder="Search news…" aria-label="Search news">
                        <button class="btn" type="submit">Search</button>
                    </form>
                    <div class="news-filters">
                        <a class="news-all active" href="#">All</a>
                        <button type="button" class="news-filter" data-range="today">Today</button>
                        <button type="button" class="news-filter" data-range="week">This Week</button>
                        <button type="button" class="news-filter" data-range="month">This Month</button>
                    </div>
                </div>
                <div class="news-side-listhead">
                    <button type="button" class="news-sort" aria-expanded="false" aria-label="Sort news">
                        <span class="news-sort-label">Newest first</span>
                        <svg class="news-sort-caret" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <div class="news-sort-menu">
                        <button type="button" class="news-sort-option active" data-sort="date-desc">Newest first</button>
                        <button type="button" class="news-sort-option" data-sort="date-asc">Oldest first</button>
                        <button type="button" class="news-sort-option" data-sort="title-asc">Title A–Z</button>
                        <button type="button" class="news-sort-option" data-sort="title-desc">Title Z–A</button>
                    </div>
                </div>
                <div class="news-side-list">
                    <?php foreach ($sideItems as $it): ?>
                        <a class="news-side-item<?= $it['link'] === $currentHref ? ' current' : '' ?>" data-date="<?= (int) $it['date'] ?>" href="<?= $it['link'] ?>">
                            <h5 class="date" style="text-transform: uppercase;"><?= $it['date'] ? strtoupper(date("F j, Y", $it['date'])) : '' ?></h5>
                            <h4><?= $it['title'] ?></h4>
                        </a>
                    <?php endforeach; ?>
                </div>
            </aside>
        </div>
    </section>

    <?php include('./_footer.php'); ?>

    <?php if (isset($onenewsItem) && $onenewsItem): ?>
        <!-- segment-rendered details load news.js via _main; onenews.js needed here too -->
        <script src="<?= $config->urls->templates ?>scripts/onenews.js"></script>
    <?php endif; ?>

</div>
