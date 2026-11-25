<?php
namespace ProcessWire;



?>

<div id="content">
    <header>
        <?php include('./_nav.php'); ?>
    </header>
    
    <section class="sub-nav" data-nav-color="dark">
        <div class="media-nav">
            <a href="<?= $pages->get('/media/photo-gallery/')->url ?>"
                class="<?= $page->name === 'photo-gallery' ? 'active' : '' ?>">
                Photo gallery
            </a>

            <a href="<?= $pages->get('/media/videos/')->url ?>" class="<?= $page->name === 'videos' ? 'active' : '' ?>">
                Videos
            </a>
        </div>

    </section>
    <section class="photo-gallery" data-nav-color="light">
        <div class="gallery" edit="gallery_images">
            <?php foreach ($page->gallery_images as $image): ?>
                <img src="<?= $image->size(800, 800)->url ?>" alt="">
            <?php endforeach; ?>
        </div>
    </section>

    <?php include('./_footer.php'); ?>



</div>