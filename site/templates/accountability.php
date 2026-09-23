<?php
namespace ProcessWire;

$formatSize = function ($bytes) {
    if (!$bytes) return '';
    return $bytes >= 1048576 ? round($bytes / 1048576, 1) . ' MB' : round($bytes / 1024) . ' KB';
};

$pdfGroup = function ($typeId) use ($page) {
    $cards = [];
    foreach ($page->pdf_cards as $c) {
        if ((int) $c->info_type->id === $typeId) $cards[] = $c;
    }
    return $cards;
};

$renderPdfGroup = function ($cards) use ($config, $formatSize) {
    $limit = 6;
    ?>
    <div class="horizontal-cards">
        <?php foreach ($cards as $i => $card): ?>
            <?php if ($i === $limit): ?><div class="more-cards"><?php endif; ?>
            <div class="horizontal-card" edit="pdf_cards" data-pdf='<?= $card->pdf_file->url ?>'>
                <div class="card-left">
                    <div class="icon pdf">
                        <img src="<?= $config->urls->templates ?>/icons/pdf.png" alt="icon">
                    </div>
                    <div class="text-card">
                        <p edit='title' class="body-bold"><?= $card->title ?></p>
                        <p class="small"><?= $formatSize($card->pdf_file->filesize) ?> • PDF</p>
                    </div>
                </div>
                <div class="icon download">
                    <a href="<?= $card->pdf_file->url ?>" download>
                        <img src="<?= $config->urls->templates ?>/icons/file_download.png" alt="icon">
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (count($cards) > $limit): ?></div><?php endif; ?>
    </div>
    <?php if (count($cards) > $limit): ?>
        <button class="expand-cards-btn" type="button" data-more="See <?= count($cards) - $limit ?> more">
            <span class="expand-cards-label">See <?= count($cards) - $limit ?> more</span>
            <svg class="expand-cards-arrow" width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L7 7L13 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    <?php endif; ?>
    <?php
};

?>


<div id="content">

    <header>
        <?php include('./_nav.php'); ?>

        <section data-nav-color="light">
            <div class="header-central">
                <div class="eyebrow">
                    <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                    <h5 style="text-transform: uppercase;">OUR COMMITMENT</h5>
                </div>
                <h2 edit="hero_title1"><?= $page->hero_title1 ?> <span  edit="born_orange_title"class="orange-text"><?= $page->born_orange_title ?></span></h2>
            </div>
            <div class="header-account">
                <p edit="hero_description"><?= $page->hero_description ?></p>
                <div class="galerie-account">
                   
                    <div edit="hero_image,image_description2" class="photo-l">
                        <img src="<?= $page->hero_image->url ?>"
                            alt="<?= htmlspecialchars($page->image_description2) ?>">
                    </div>

                </div>
            </div>


        </section>
    </header>
    <section class="legal" data-nav-color="dark">
        <div class="container-left">
            <h3 edit="title"><?= $page->title ?></h3>
            <div class="status-content">
                <div class="line-legal">
                    <div class="icon">
                        <img src="<?= $config->urls->templates ?>/icons/trinagle-dark.png" alt="icon">
                    </div>
                    <div class="text">
                        <p edit="card_title" class="body-bold"><?= $page->card_title ?></p>
                        <p edit="card_number"><?= $page->card_number ?></p>
                    </div>
                </div>
                <div class="line-legal">
                    <div class="icon">
                        <img src="<?= $config->urls->templates ?>/icons/trinagle-dark.png" alt="icon">
                    </div>
                    <div class="text">
                        <p edit="card_title2" class="body-bold"><?= $page->card_title2 ?></p>
                        <p edit="card_title3"><?= $page->card_title3 ?></p>
                    </div>
                </div>
                <div class="line-legal">
                    <div class="icon">
                        <img src="<?= $config->urls->templates ?>/icons/trinagle-dark.png" alt="icon">
                    </div>
                    <div class="text">
                        <p edit="card_title4" class="body-bold"><?= $page->card_title4 ?></p>
                        <p edit="card_number4"><?= $page->card_number4 ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-right">
            <h3 edit="areas_title"><?= $page->areas_title ?></h3>
            <!-- <?php if ($user->isLoggedin()): ?>
                <p  class="btn account-btn"
                    edit="account_cards"
                    
                    >Double click here to add or remove Members and Executive Cards</p> 
                    
            <?php endif; ?> -->
            <div class="members">
                <h4 edit="hero_title2"><?= $page->hero_title2 ?></h4>
                <div class="horizontal-cards">
                    <?php foreach ($page->account_cards as $card): ?>
                       <?php if ((int) $card->member_type->id === 2): ?> 

                    <!-- <div class="column-left"> -->
                        <div edit="account_cards" class="horizontal-card">
                            <div class="icon">
                                <img src="<?= $config->urls->templates ?>/icons/avatar.png" alt="icon">
                            </div>
                            <div class="text">
                                <p edit="account_card_name" class="body-bold"><?= $card->account_card_name ?></p>
                                <p edit="account_card_function" class="small"><?= $card->account_card_function ?></p>
                            </div>
                        </div>


                        <!-- <div class="horizontal-card">
                            <div class="icon">
                                <img src="/icons/avatar.png" alt="icon">
                            </div>
                            <div class="text">
                                <p edit="card_title7" class="body-bold">Maya Gurung</p>
                                <p edit="card_title8" class="small">Vice Chair</p>
                            </div>
                        </div> -->
                    <!-- </div> -->
                    <!-- <div class="column-right"> -->
                      <!--   <div class="horizontal-card">
                            <div class="icon">
                                <img src="/icons/avatar.png" alt="icon">
                            </div>
                            <div class="text">
                                <p edit="card_title9" class="body-bold">Maya Gurung</p>
                                <p edit="card_title10" class="small">Vice Chair</p>
                            </div>
                        </div>
                        <div class="horizontal-card">
                            <div class="icon">
                                <img src="/icons/avatar.png" alt="icon">
                            </div>
                            <div class="text">
                                <p class="body-bold">Maya Gurung</p>
                                <p class="small">Vice Chair</p>
                            </div>
                        </div> -->
                    <!-- </div> -->
                    <?php endif; ?>
                     <?php endforeach; ?>
                </div>
            </div>
            <?php if($page->account_cards->find("member_type=1")->count()): ?>
            <div class="executive">
                <h4>Executive Team</h4>
                <div class="horizontal-cards">
                   <!--  <div class="column-left"> -->
                   <?php foreach ($page->account_cards as $card): ?>
                    <?php if ((int) $card->member_type->id === 1): ?> 
                        <div edit="account_cards" class="horizontal-card">
                            <div class="icon">
                                <img src="<?= $config->urls->templates ?>/icons/avatar.png" alt="icon">
                            </div>
                            <div class="text">
                                <p edit="account_card_name" class="body-bold"><?= $card->account_card_name ?></p>
                                <p edit="account_card_function" class="small"><?= $card->account_card_function ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                       <!--  <div class="horizontal-card">
                            <div class="icon">
                                <img src="<?= $config->urls->templates ?>/icons/avatar.png" alt="icon">
                            </div>
                            <div class="text">
                                <p class="body-bold">Maya Gurung</p>
                                <p class="small">Vice Chair</p>
                            </div>
                        </div>
                        <div class="horizontal-card">
                            <div class="icon">
                                <img src="<?= $config->urls->templates ?>/icons/avatar.png" alt="icon">
                            </div>
                            <div class="text">
                                <p class="body-bold">Maya Gurung</p>
                                <p class="small">Vice Chair</p>
                            </div>
                        </div>
                        <div class="horizontal-card">
                            <div class="icon">
                                <img src="<?= $config->urls->templates ?>/icons/avatar.png" alt="icon">
                            </div>
                            <div class="text">
                                <p class="body-bold">Maya Gurung</p>
                                <p class="small">Vice Chair</p>
                            </div>
                        </div> -->
                   <!--  </div> -->
                  <!--   <div class="column-right"> -->

                       <!--  <div class="horizontal-card">
                            <div class="icon">
                                <img src="<?= $config->urls->templates ?>/icons/avatar.png" alt="icon">
                            </div>
                            <div class="text">
                                <p class="body-bold">Maya Gurung</p>
                                <p class="small">Vice Chair</p>
                            </div>
                        </div>
                        <div class="horizontal-card">
                            <div class="icon">
                                <img src="<?= $config->urls->templates ?>/icons/avatar.png" alt="icon">
                            </div>
                            <div class="text">
                                <p class="body-bold">Maya Gurung</p>
                                <p class="small">Vice Chair</p>
                            </div>
                        </div>
                        <div class="horizontal-card">
                            <div class="icon">
                                <img src="<?= $config->urls->templates ?>/icons/avatar.png" alt="icon">
                            </div>
                            <div class="text">
                                <p class="body-bold">Maya Gurung</p>
                                <p class="small">Vice Chair</p>
                            </div>
                        </div> -->

                    <!-- </div> -->
                </div> <!-- horizontal cards ---->
            </div> <!---- executive ---->
            <?php endif; ?>
        </div>
    </section>
    <section class="financial" data-nav-color="light">
        <div class="header-central">
            <h2>Financial transparency</h2>
            <p>Explore our annual reports, financial statements, and key documents to see how resources are managed and
                impact is delivered.</p>
        </div>
        <div class="financial-content">
            <div class="column">
                <h4>Annual Reports</h4>
                <?php $renderPdfGroup($pdfGroup(1)); ?>
            </div>
            <div class="column">
                <h4>Financial Statements</h4>
                <?php $renderPdfGroup($pdfGroup(2)); ?>
            </div>
        </div> <!--- financial content ---->
    </section>
    <section class="policies" data-nav-color="dark">
        <div class="header-central">
            <h2>Policies & Safeguarding</h2>
            <p>FAITH works with some of the most vulnerable women in Nepal — women living with HIV, survivors of
                violence, women who use drugs, women who face daily stigma and institutional discrimination. The
                policies below exist to protect them, to protect our staff, and to ensure that FAITH itself does not
                replicate the harm it was founded to address.
            </p>
        </div>
    <div class="column">
        <h4>Policy documents</h4>
        <?php $renderPdfGroup($pdfGroup(3)); ?>
    </div> <!-- column -->
    </section>
    <section class="concern">
        <div class="header-central">
            <h2>Have a concern?</h2>
            <p>For safeguarding concerns, programme complaints, or feedback, contact our team. We take all concerns
                seriously and respond within defined timeframes.</p>
            <a class="btn green concern-btn" href="/contact">
                Contact Us
                <img src="<?= $config->urls->templates ?>icons/arrow_forward_white.png" alt="icon-arrow">
            </a>
        </div>
    </section>

    <?php include('./_footer.php'); ?>


</div>