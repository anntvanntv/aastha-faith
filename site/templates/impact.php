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
            <?php if ($user->isLoggedin()): ?>
                <p class="admin-info">If you need to change the numbers or subtitles in this section, click this button to open the Impact
                    admin area.

                    Look for the fields labelled card_number and card_title, through to card_number9 and card_title9. They
                    correspond to the cards on the page in this order: from left to right on the first row, then from left
                    to right on the second row, and finally from left to right on the third row.
                    Please don’t edit the cards in this section directly on the page.
                </p>
                <a href="<?= $config->urls->admin ?>page/edit/?id=1027=<?= $page->id ?>" class="btn change-impact-btn">
                    Change Impact Numbers ->
                </a>
            <?php endif; ?>
            <div class="in-numbers-wrap">
                <div class="reach visible">

                    <div class="static-cards">
                        <div class="static-card">
                            <h2 edit="card_number" class="light-orange-text"><?= $page->card_number ?></h2>
                            <p edit="card_title"><?= $page->card_title ?></p>
                        </div>
                        <div class="static-card">
                            <h2 edit="card_number2" class="light-orange-text"><?= $page->card_number2 ?></h2>
                            <p edit="card_title2"><?= $page->card_title2 ?></p>
                        </div>
                        <div class="static-card">
                            <h2 edit="card_number3" class="light-orange-text"><?= $page->card_number3 ?></h2>
                            <p edit="card_title3"><?= $page->card_title3 ?></p>
                        </div>

                    </div>
                </div>
                <div class="economic hidden">

                    <div class="static-cards">
                        <div class="static-card">
                            <h2 edit="card_number4" class="light-orange-text"><?= $page->card_number4 ?></h2>
                            <p edit="card_title4"><?= $page->card_title4 ?></p>
                        </div>
                        <div class="static-card">
                            <h2 edit="card_number5" class="light-orange-text"><?= $page->card_number5 ?></h2>
                            <p edit="card_title5"><?= $page->card_title5 ?></p>
                        </div>
                        <div class="static-card">
                            <h2 edit="card_number6" class="light-orange-text"><?= $page->card_number6 ?></h2>
                            <p edit="card_title6"><?= $page->card_title6 ?></p>
                        </div>

                    </div>
                </div>
                <div class="people hidden">

                    <div class="static-cards">
                        <div class="static-card">
                            <h2 edit="card_number7" class="light-orange-text"><?= $page->card_number7 ?></h2>
                            <p edit="card_title7"><?= $page->card_title7 ?></p>
                        </div>
                        <div class="static-card">
                            <h2 edit="card_number8" class="light-orange-text"><?= $page->card_number8 ?></h2>
                            <p edit="card_title8"><?= $page->card_title8 ?></p>
                        </div>
                        <div class="static-card">
                            <h2 edit="card_number9" class="light-orange-text"><?= $page->card_number9 ?></h2>
                            <p edit="card_title9"><?= $page->card_title9 ?></p>
                        </div>

                    </div>
                </div>
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
                <div class="news-card a">
                    <div class="ncard-picture"></div>
                    <div class="programme-title">
                        <p class="small">programme</p>
                        <h5 class="date" style="text-transform: uppercase;">may 2026</h5>
                    </div>
                    <div class="ncard-content">
                        <div class="title-content">
                            <h4>Heading</h4>
                            <p>New outreach brings trained counselors to Nepal's most remote regions through
                                partnerships
                                with local government health posts.</p>
                        </div>
                        <div class="btn-content">
                            <div class="btn emptyblack">
                                Button text
                                <img src="<?= $config->urls->templates ?>icons/arrow_forward.png" alt="icon_arrow">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="news-card b">
                    <div class="ncard-picture"></div>
                    <div class="programme-title">
                        <p class="small">programme</p>
                        <h5 class="date" style="text-transform: uppercase;">may 2026</h5>
                    </div>
                    <div class="ncard-content">
                        <div class="title-content">
                            <h4>Heading</h4>
                            <p>New outreach brings trained counselors to Nepal's most remote regions through
                                partnerships
                                with local government health posts.</p>
                        </div>
                        <div class="btn-content">
                            <div class="btn emptyblack">
                                Button text
                                <img src="<?= $config->urls->templates ?>icons/arrow_forward.png" alt="icon_arrow">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="news-card c">
                    <div class="ncard-picture"></div>
                    <div class="programme-title">
                        <p class="small">programme</p>
                        <h5 class="date" style="text-transform: uppercase;">may 2026</h5>
                    </div>
                    <div class="ncard-content">
                        <div class="title-content">
                            <h4>Heading</h4>
                            <p>New outreach brings trained counselors to Nepal's most remote regions through
                                partnerships
                                with local government health posts.</p>
                        </div>
                        <div class="btn-content">
                            <div class="btn emptyblack">
                                Button text
                                <img src="<?= $config->urls->templates ?>icons/arrow_forward.png" alt="icon_arrow">
                            </div>
                        </div>
                    </div>
                </div>
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
            <a class="btn green" href="/donate">
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