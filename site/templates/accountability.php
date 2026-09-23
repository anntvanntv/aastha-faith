<?php
namespace ProcessWire;

$formatSize = function ($bytes) {
    if (!$bytes) return '';
    return $bytes >= 1048576 ? round($bytes / 1048576, 1) . ' MB' : round($bytes / 1024) . ' KB';
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
                <div class="horizontal-cards">
                    <?php foreach ($page->pdf_cards as $card): ?>
                        <?php if ((int) $card->info_type->id === 1): ?>
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
                                <div class="icon download" >
                                      <a href="<?= $card->pdf_file->url ?>" download>
                                        <img src="<?= $config->urls->templates ?>/icons/file_download.png" alt="icon">
                                      </a>
                                    </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="column">
                <h4>Financial Statements</h4>
                <div class="horizontal-cards">
                    <?php foreach ($page->pdf_cards as $card): ?>
                        <?php if ((int) $card->info_type->id === 2): ?>
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
                                <div class="icon download" >
                                      <a href="<?= $card->pdf_file->url ?>" download>
                                        <img src="<?= $config->urls->templates ?>/icons/file_download.png" alt="icon">
                                      </a>
                                    </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
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
        <div class="horizontal-cards">

        <?php foreach ($page->pdf_cards as $card): ?>
                    <?php if ((int) $card->info_type->id === 3): ?>
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
                            <div class="icon download" >
                                  <a href="<?= $card->pdf_file->url ?>" download>
                                    <img src="<?= $config->urls->templates ?>/icons/file_download.png" alt="icon">
                                  </a>
                                </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
              
               <!--  <div class="horizontal-card">
                    <div class="card-left">
                        <div class="icon pdf">
                            <img src="<?= $config->urls->templates ?>/icons/pdf.png" alt="icon">
                        </div>
                        <div class="text-card">
                            <p class="body-bold">Safeguarding</p>
                            <p class="small">2.4 MB • PDF</p> -->
                        <!-- </div> --> <!-- text card --->
                    <!-- </div> --><!-- card left --->
                    <!-- <div class="icon download">
                        <img src="<?= $config->urls->templates ?>/icons/file_download.png" alt="icon">
                    </div>
                </div> --><!--  horizontal card --->
                <!-- <div class="horizontal-card">
                    <div class="card-left">
                        <div class="icon pdf">
                            <img src="<?= $config->urls->templates ?>/icons/pdf.png" alt="icon">
                        </div>
                        <div class="text-card">
                            <p class="body-bold">Child Protection</p>
                            <p class="small">2.4 MB • PDF</p>
                        </div> --> <!-- text card --->
                    <!-- </div> --><!--- card left --->
                    <!-- <div class="icon download">
                        <img src="<?= $config->urls->templates ?>/icons/file_download.png" alt="icon">
                    </div>
                </div> --><!--  horizontal card --->
                <!-- <div class="horizontal-card">
                    <div class="card-left">
                        <div class="icon pdf">
                            <img src="<?= $config->urls->templates ?>/icons/pdf.png" alt="icon">
                        </div>
                        <div class="text-card">
                            <p class="body-bold">Anti-Discrimination</p>
                            <p class="small">2.4 MB • PDF</p>
                        </div> --> <!-- text card --->
                    <!-- </div> --><!---card left  -->
                    <!-- <div class="icon download">
                        <img src="<?= $config->urls->templates ?>/icons/file_download.png" alt="icon">
                    </div>
                </div> --><!--  horizontal card --->
         
                <!-- <div class="horizontal-card">
                    <div class="card-left">
                        <div class="icon pdf">
                            <img src="<?= $config->urls->templates ?>/icons/pdf.png" alt="icon">
                        </div>
                        <div class="text-card">
                            <p class="body-bold">Data Protection</p>
                            <p class="small">2.4 MB • PDF</p>
                        </div> --> <!-- text card --->
                    <!-- </div> --><!-- card left --->
                    <!-- <div class="icon download">
                        <img src="<?= $config->urls->templates ?>/icons/file_download.png" alt="icon">
                    </div>
                </div> --><!--  horizontal card --->
                <!-- <div class="horizontal-card">
                    <div class="card-left">
                        <div class="icon pdf">
                            <img src="<?= $config->urls->templates ?>/icons/pdf.png" alt="icon">
                        </div>
                        <div class="text-card">
                            <p class="body-bold">Complaints Procedure</p>
                            <p class="small">2.4 MB • PDF</p>
                        </div> --> <!-- text card --->
                    <!-- </div> --><!-- card left --->
                    <!-- <div class="icon download">
                        <img src="<?= $config->urls->templates ?>/icons/file_download.png" alt="icon">
                    </div>
                </div> --><!--  horizontal card --->
                <!-- <div class="horizontal-card">
                    <div class="card-left">
                        <div class="icon pdf">
                            <img src="<?= $config->urls->templates ?>/icons/pdf.png" alt="icon">
                        </div>
                        <div class="text-card">
                            <p class="body-bold">Conflict of Interest</p>
                            <p class="small">2.4 MB • PDF</p>
                        </div> --> <!-- text card --->
                    <!-- </div> --><!--card left -->


                    <!-- <div class="icon download">
                        <img src="<?= $config->urls->templates ?>/icons/file_download.png" alt="icon">
                    </div>

                </div> --><!--  horizontal card --->

        


        </div> <!--- horizontal cards ----->
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