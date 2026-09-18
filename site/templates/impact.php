<?php
namespace ProcessWire;



?>

<div id="content">
    <header>
        <?php include('./_nav.php'); ?>
        <section class="impact-header-content" data-nav-color="dark">
            <div class="eyebrow">
                <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                <h5 style="text-transform: uppercase;">measurable change</h5>
            </div>
            <div class="title-section">
                <h1 edit="hero_title1"><?= $page->hero_title1 ?><span edit="born_orange_title" class="orange-text"> <?= $page->born_orange_title ?></span></h1>
                <p edit="hero_description"><?= $page->hero_description ?> </p>
            </div>
        </section>
        <section class="picture-section" data-nav-color="light">
            <div edit="hero_image" class="nepal-people-photo">
                <img src="<?= $page->hero_image->url ?>">

            </div>

        </section>
    </header>

    <section class="in-numbers impact-wrapper" data-nav-color="light">
        <div class="sticky-element">
            <div class="in-numbers-heading">
                <div class="heading-left">
                    <div class="eyebrow">
                        <img class="wave" src="<?= $config->urls->templates ?>icons/wave.png" alt="icon-wave">
                        <h5>closer look</h5>
                    </div>
                    <h2 edit="hero_title2"><?= $page->hero_title2 ?></h2>
                </div>
            </div>
           
            <div class="in-numbers-wrap">
                <?php
                // card 1 uses unsuffixed fields (card_number/card_title); cards 2-15 are suffixed
                $renderCard = function($n) use ($page) {
                    $sfx = $n === 1 ? '' : $n;
                    if(!$page->get("card_number$sfx") && !$page->get("card_title$sfx")) return;
                    ?>
                    <div class="static-card">
                        <h2 edit="card_number<?= $sfx ?>" class="light-orange-text"><?= $page->get("card_number$sfx") ?></h2>
                        <p edit="card_title<?= $sfx ?>"><?= $page->get("card_title$sfx") ?></p>
                    </div>
                    <?php
                };

                $cardGroups = [
                    ['reach', [1,2,3]],
                    ['economic', [4,5,6]],
                    ['people', [7,8,9]],
                ];
                $extraRows = [[10,11,12],[13,14,15]];

                $hasExtra = false;
                foreach($extraRows as $row){
                    foreach($row as $n){
                        if($page->get("card_number$n") || $page->get("card_title$n")){ $hasExtra = true; break 2; }
                    }
                }
                ?>

                <?php foreach($cardGroups as [$cls, $nums]): ?>
                <div class="<?= $cls ?>">
                    <div class="static-cards">
                        <?php foreach($nums as $n) $renderCard($n); ?>
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- Extra card rows collapse behind the expand arrow -->
                <?php if($hasExtra): ?>
                <div class="more-cards" id="moreCards">
                    <?php foreach($extraRows as $row): ?>
                    <div class="extra-row">
                        <div class="static-cards">
                            <?php foreach($row as $n) $renderCard($n); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <button class="expand-cards-btn" id="expandCardsBtn" aria-expanded="false">
                    <span class="expand-cards-label">Show more</span>
                    <svg class="expand-cards-arrow" width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L7 7L13 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <section data-nav-color="dark">
        <div class="beyond-content">
            <div class="header-left">
                <div class="eyebrow">
                    <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                    <h5 style="text-transform: uppercase;">change in action</h5>
                </div>
                <h2 edit="areas_title"><?= $page->areas_title ?></h2>
            </div>
            <div class="cards-beyond">
                <?php
                $cardClasses = ['a', 'b', 'c'];
                $latestStories = $pages->get('/stories/')->children("sort=-date,limit=3");
                $i = 0;
                foreach($latestStories as $story):
                    $cls = $cardClasses[$i] ?? 'a';
                ?>
                <div class="news-card <?= $cls ?>">
                    <div class="ncard-picture">
                        <?php if($story->image): ?>
                        <img src="<?= $story->image->url ?>" alt="<?= $story->title ?>">
                        <?php endif; ?>
                    </div>
                    <div class="programme-title">
                        <p class="small"><?= $story->category ?></p>
                        <h5 class="date" style="text-transform: uppercase;"><?= $story->date ? strtoupper(date("F Y", $story->date)) : '' ?></h5>
                    </div>
                    <div class="ncard-content">
                        <div class="title-content">
                            <h4><?= $story->title ?></h4>
                            <p><?= substr(strip_tags($story->body), 0, 180) ?>...</p>
                        </div>
                        <div class="btn-content">
                            <a href="<?= $story->url ?>" class="btn emptyblack">
                                Read more
                                <img src="<?= $config->urls->templates ?>icons/arrow_forward.png" alt="icon_arrow">
                            </a>
                        </div>
                    </div>
                </div>
                <?php $i++; endforeach; ?>
            </div>
            <div class="see-more-stories">
                <a href="<?= $pages->get('/stories/')->url ?>" class="btn emptyblack">
                    See More Stories
                    <img src="<?= $config->urls->templates ?>icons/arrow_forward.png" alt="icon_arrow">
                </a>
            </div>

        </div>

    </section>
    <section class="impact-footer" data-nav-color="light">
        <div class="header-central">
            <div class="eyebrow">
                <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                <h5 style="text-transform: uppercase;">stand with us</h5>
            </div>
            <h2>Support our work</h2>
            <p>Every contribution helps FAITH reach more women, open more doors, and create more pathways to dignity
                and independence across Nepal.</p>
            <a class="btn green" href="<?= $pages->get('/donors/')->url ?>">
                Donate now
                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5.33333 0L4.39333 0.94L8.11333 4.66667H0V6H8.11333L4.39333 9.72667L5.33333 10.6667L10.6667 5.33333L5.33333 0Z"
                        fill="currentColor" />
                </svg>

            </a>
        </div>
        <div class="vector-footer">
            <img src="<?= $config->urls->templates ?>icons/Vector 5.png" alt="icon">
            <p>We respond to all funding and partnership enquiries within 48 hours</p>

        </div>
    </section>

    <?php include('./_footer.php'); ?>

</div>