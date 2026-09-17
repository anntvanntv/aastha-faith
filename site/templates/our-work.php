<?php
namespace ProcessWire;



?>



<div id="content">
        <header>
                <?php include('./_nav.php'); ?>
                <section class="our-work-content">

                    <div class="eyebrow">
                        <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                        <h5 style="text-transform: uppercase;">Our work</h5>
                    </div>
                    <div class="title-section">
                        <h1 edit="title"><?= $page->title ?></h1>

                    

                    </div>
          
                </section>
        </header>

        <!-- Section 1: Creating change where it matters most — dynamic cards from areas_cards repeater -->
        <section class="areas">
            <div class="areas-heading">
                <h2 edit="change_section_title"><?= $page->change_section_title ?></h2>
            </div>
            <div class="cards-section-area">
                <?php foreach ($page->areas_cards as $card): ?>
                    <div class="vertical-card">
                        <img src="<?= $card->areas_card_image->url ?>">

                        <h4><?= $card->areas_card_title ?></h4>
                        <p><?= $card->areas_card_text ?></p>
                    </div>

                <?php endforeach; ?>   
            </div>   
        </section>

        <!-- Section 2: Ongoing Projects — lists child pages (onework template) -->
        <section class="our-work-main">
            <div edit="image_left" class="image-left">
                <img src="<?= $page->image_left->url ?>" alt="">
            </div>
            <div class="content-right">       
                <h2 edit="projects_section_title"><?= $page->projects_section_title ?></h2>
                <?php if ($user->isLoggedin()): ?>
                    <a href="<?= $config->urls->admin ?>page/add/?parent_id=<?= $page->id ?>" class="btn add-story-btn">
                        Add New Work
                    </a>
                <?php endif; ?>
                <?php foreach ($page->children() as $work): ?>
                    <div class="our-work-card">
                        <h3><?= $work->title ?></h3>
                        <p>Objective: <?= substr(strip_tags($work->objective), 0, 180) ?></p>
                        <a class="btn ow-btn" href="<?= $work->url ?>">Read more  <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.33333 0L4.39333 0.94L8.11333 4.66667H0V6H8.11333L4.39333 9.72667L5.33333 10.6667L10.6667 5.33333L5.33333 0Z"
                                fill="currentColor" />
                        </svg>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>

        </section>

        <?php include('./_footer.php'); ?>


</div>