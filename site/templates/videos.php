<?php
namespace ProcessWire;



?>

<div id="content">
    <header>
    <?php include('./_nav.php'); ?>
   
 

        </header>
        <section class="sub-nav">
            <div class="media-nav">
                <a href="<?= $pages->get('/media/photo-gallery/')->url ?>"
                class="<?= $page->name === 'photo-gallery' ? 'active' : '' ?>">
                    Photo gallery
                </a>

                <a href="<?= $pages->get('/media/videos/')->url ?>"
                class="<?= $page->name === 'videos' ? 'active' : '' ?>">
                Videos
                </a>
            </div>

        </section>

        <section class="video-box">
            <div class="video-text">
                <div class="title">
                    <h3>RATO PACHHAURI-A tale of Turmoil, Temptation and Triumph-2023</h3>
                </div>
                <div class="content">
                    <p>Rato Pachhauri is a short film manifesting struggle in life of female sex workers to live their rights and provisions fully. The film was selected for the 
                    Eurofilm Festival 2024.  </p>
                </div>
            </div>
            <div class="video-video">
                <img src="<?= $config->urls->templates ?>images/video/video.jpg" alt="">
            </div>
        </section>

        <?php include('./_footer.php'); ?>

       


</div>