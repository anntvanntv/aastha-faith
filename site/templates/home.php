<?php
namespace ProcessWire;

// Template file for “home” template used by the homepage
// ------------------------------------------------------
// The #content div in this file will replace the #content div in _main.php
// when the Markup Regions feature is enabled, as it is by default. 
// You can also append to (or prepend to) the #content div, and much more. 
// See the Markup Regions documentation:
// https://processwire.com/docs/front-end/output/markup-regions/

?>

<div id="content">
    <header edit="hero_image" style="background-image: url('<?= $page->hero_image->url ?>');">
        <?php include('./_nav.php'); ?>
        <section class="hero-content">

            <div class="eyebrow">
                <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                <h5 style="text-transform: uppercase;">Nepal · Est. 2005 · 20 Years of Change</h5>
            </div>
            <div class="title-section">
                <h1 edit="hero_title1"><?= $page->hero_title1 ?></h1>
                <h1 edit="hero_title2"><?= $page->hero_title2 ?></h1>
                <h1 edit="hero_title3"><?= $page->hero_title3 ?></h1>
            </div>
            <div class="description">
                <p edit="hero_description"><?= $page->hero_description ?></p>
            </div>
            <div class="btn-section">
               <!--  <a class="btn orange herocbtn" href="<?= $pages->get('/impact/')->url ?>">See our impact
                    <img src="<?= $config->urls->templates ?>icons/arrow_forward_white.png" alt="icon">
                </a> -->
                <a class="btn transparent herocbtn" href="<?= $pages->get('/contact/')->url ?>">
                    Partner with us
                    <img src="<?= $config->urls->templates ?>icons/arrow_forward_orange.png" alt="icon">
                </a>

            </div>
            <div class="highlight">
                <img src="<?= $config->urls->templates ?>icons/highlight-hero-home.svg" alt="icon">
            </div>

        </section>
    </header>

    <main>
        <section id="video-section" class="video-section" data-nav-color="dark">
            <div class="video-heading">
                <div class="eyebrow">
                    <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                    <img class="our" src="<?= $config->urls->templates ?>icons/ourimpact.png" alt="">
                </div>
                <h2 edit="video_title"><?= $page->video_title ?>
                    <span edit="video_title_orange" class="orange-text"><?= $page->video_title_orange ?></span>
                </h2>
            </div>
            <div class="video-wrapper">
                <video id="myVideo" edit="video">
                    <source src="<?= $page->video->url ?>">
                </video>
                <button class="play-btn">▶</button>
            </div>
        </section>

        <section id="stats" class="stats" data-nav-color="dark">
            <div class="stats-heading">
                <div class="heading-left">
                    <div class="eyebrow">
                        <img class="wave" src="<?= $config->urls->templates ?>icons/wave.png" alt="icon-wave">
                        <img class="our" src="<?= $config->urls->templates ?>icons/ourimpact.png" alt="icon">
                    </div>
                    <h2 edit="title_change"><?= $page->title_change ?></h2>
                </div>
                <div class="heading-right">
                    <a class="btn white statsbtn" href="<?= $pages->get('/impact/')->url ?>">
                        Learn about impact
                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.33333 0L4.39333 0.94L8.11333 4.66667H0V6H8.11333L4.39333 9.72667L5.33333 10.6667L10.6667 5.33333L5.33333 0Z"
                                fill="currentColor" />
                        </svg>


                    </a>
                </div>
            </div> <!---end stats-heading-->
            <div class="cards-section">
            <div class="map-area"><iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7065.95801099961!2d85.30852979709088!3d27.687043755168673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19b4ad7096dd%3A0x29fa3d73b99dcc97!2sKupondole%2C%20Patan%2C%20Zona%20de%20Bagmati%2044600%2C%20Nepal!5e0!3m2!1ses!2sde!4v1789045329645!5m2!1sen!2sde"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>
               <!--  <div class="card">
                    <h2 edit="card_number"><?= $page->card_number ?></h2>
                    <p edit="card_title"><?= $page->card_title ?></p>
                </div>
                <div class="card">
                    <h2 edit="card_number2"><?= $page->card_number2 ?></h2>
                    <p edit="card_title2"><?= $page->card_title2 ?></p>
                </div>
                <div class="card">
                    <h2 edit="card_number3"><?= $page->card_number3 ?></h2>
                    <p edit="card_title3"><?= $page->card_title3 ?></p>
                </div>
                <div class="card">
                    <h2 edit="card_number4"><?= $page->card_number4 ?></h2>
                    <p edit="card_title4"><?= $page->card_title4 ?></p>
                </div> -->
            </div>

        </section>
        <section id="born" class="born" data-nav-color="light">
            <div class="born-container">
                <div class="b-heading">
                    <div class="eyebrow">
                        <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                        <h5 style="text-transform: uppercase;">who we are</h5>
                    </div>
                    <div class="born-title">
                        <h2 class="w-500" edit="born_title"><?= $page->born_title ?></h2>
                        <h2 class="led"><span class="nowrap"
                                edit="born_orange_title"><?= $page->born_orange_title ?></span></h2>
                        <img src="<?= $config->urls->templates ?>icons/Line.png">
                    </div>
                </div> <!---end b-heading-->
                <div class="born-text">
                    <p edit="born_text">
                        <?= $page->born_text ?>
                    </p>
                </div>
                <a class="btn green" href="<?= $pages->get('/about-us/')->url ?>">Read our full story
                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">

                        <path
                            d="M5.33333 0L4.39333 0.94L8.11333 4.66667H0V6H8.11333L4.39333 9.72667L5.33333 10.6667L10.6667 5.33333L5.33333 0Z"
                            fill="currentColor" />

                    </svg>
                </a>

            </div>


            <div class="born-photo" edit="born_image">
                <img src="<?= $page->born_image->url ?>" alt="">
            </div>

            <div class="percent">
                <img src="<?= $config->urls->templates ?>icons/percent.svg" alt="">
            </div>


        </section>
        <section id="areas" class="areas" data-nav-color="dark">
            <div class="areas-heading">
                <div class="left">

                    <div class="areas-title">
                        <h2 edit="areas_title"><?= $page->areas_title ?></h2>
                        <h2 edit="areas_title_orange" class="orange-text"><?= $page->areas_title_orange ?></h2>
                    </div>
                </div>
                <div class="areas-text">
                    <p>Each programme addresses a distinct dimension of the barriers women face — designed to work
                        together.</p>
                </div>
            </div>
            
            <div class="cards-section-area">


                <?php foreach ($page->areas_cards as $card): ?>
                    <a class="vertical-card-link" href="<?= $pages->get('/our-work/')->url ?>">
                        <div class="vertical-card" edit="areas_cards">

                            <img edit="<?= $card->id ?>.areas_card_image" src="<?= $card->areas_card_image->url ?>">



                            <h4 edit="<?= $card->id ?>.areas_card_title"><?= $card->areas_card_title ?></h4>
                            <p edit="<?= $card->id ?>.areas_card_text"><?= $card->areas_card_text ?></p>

                        </div>
                    </a>
                <?php endforeach; ?>
            </div>



        </section>
        <section id="quote" class="quote" data-nav-color="light">
            <div class="picture-quote">
                <img edit="quote_image" src="<?= $page->quote_image->url ?>" alt="">
            </div>
            <div class="title-quote">
                <div class="box">
                    <img src="<?= $config->urls->templates ?>icons/Vector_quote.png" alt="icon">
                    <h3 edit="quote_text" class="w-500"><?= $page->quote_text ?></h3>
                </div>
                <div class="box">
                    <div class="subtitle">
                        <img src="<?= $config->urls->templates ?>icons/wave.png" alt="icon">
                        <div class="text-subtitle">
                            <h4 edit="quote_title"><?= $page->quote_title ?></h4>
                            <p edit="quote_subtitle" class="small"><?= $page->quote_subtitle ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mirrored version of #quote: image right, text left (.quote2 uses row-reverse) -->
        <section id="quote2" class="quote2" data-nav-color="dark">
            <div class="picture-quote2">
                <img edit="quote2_image" src="<?= $page->quote2_image->url ?>" alt="">
            </div>
            <div class="title-quote">
                <div class="box">
                    <img src="<?= $config->urls->templates ?>icons/Vector_quote.png" alt="icon">
                    <h3 edit="quote2_title" class="w-500"><?= $page->quote2_title ?></h3>
                    <?php if($page->quote2_text): ?>
                    <h3 edit="quote2_text" class="w-500"><?= $page->quote2_text ?></h3>
                    <?php endif; ?>
                </div>
                <div class="box">
                    <div class="subtitle">
                        <img src="<?= $config->urls->templates ?>icons/wave.png" alt="icon">
                        <div class="text-subtitle">
                            <h4 edit="signature"><?= $page->signature ?></h4>
                            <p edit="quote2_subtitle" class="small"><?= $page->quote2_subtitle ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="field" class="field" data-nav-color="dark">
            <div class="field-header">
                <div class="field-left">
                    <div class="eyebrow">
                        <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                        <h5 style="text-transform: uppercase;">Latest News</h5>
                    </div>
                    <div class="field-title">
                        <h2>From the field</h2>
                        <?php if($user->isLoggedin()): ?>
                    
                    <button edit="album_card">double-click to add a card</button>

                <?php endif; ?>
                    </div>
                </div>
                <div class="field-right">
                    <a class="btn white" href="<?= $pages->get('/stories/')->url ?>">
                        Read more stories
                        <img src="<?= $config->urls->templates ?>icons/arrow_forward.png" alt="icon">
                    </a>
                </div>
            </div>
            <div class="field-content">

         

                <?php foreach ($page->album_card as $card): ?>

                    <div edit="album_card" class="news-card">
                        <div edit='<?= $card ?>.album_card_image' class="ncard-picture">
                            <img src="<?= $card->album_card_image->url ?>" alt="">
                        </div>
                    
                        <div class="ncard-content">
                            <div class="title-content">
                                <h4 edit="<?= $card ?>.album_card_title "><?= $card->album_card_title ?></h4>
                                <div class="clamp-wrap">
                                    <p edit="<?= $card ?>.album_card_text" class="clamp-text"><?= $card->album_card_text ?></p>
                                    <button class="expand-text-btn" aria-expanded="false">Read more</button>
                                </div>
                            </div>
                        
                        </div>
                    </div> <!--end news-card-->
                <?php endforeach; ?>
               <!--  <div class="news-card b">
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
                </div> --><!--end news-card b-->
               <!--  <div class="news-card c">
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
                </div> --><!--end news-card c-->
            </div>
        </section>
    </main>

    <?php include('./_footer.php'); ?>

</div>