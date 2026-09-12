<?php
namespace ProcessWire;



?>

<div id="content">
    <header>
        <?php include('./_nav.php'); ?>

    </header>
    <section class="content404">
        <h1>404</h1>
        <h3>Page not found</h3>
        <p>Sorry, the page you're looking for doesn't exist or has been moved.</p>
        <div class="btn404">
            <a class="btn orange" href="<?= $pages->get('/')->url ?>">
                Back to home
                <img src="<?= $config->urls->templates ?>icons/arrow_forward_white.png" alt="icon-arrow">
            </a>
        </div>
    </section>

</div>