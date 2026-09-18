<?php
namespace ProcessWire

?>


<div id="content">

    <header class="onework">
        <?php include('./_nav.php'); ?>
    </header>

    <section class="one-work-content">
        <div class="title-one-work">
            <div class="arrow-btn">

                <img class="arrow_back" src="<?= $config->urls->templates ?>icons/arrow_back.png" alt="arrow">
                <a class="btn one-workbtn" href="<?= $pages->get('/our-work/')->url ?>">Back to projects</a>
            </div>
            <h2 edit="title"><?= $page->title ?></h2>

        </div>
        <div class="description-one-work">
            <div class="text-one-work">
                <div edit="objective">
                    <h5 style="text-transform:uppercase">OBJECTIVE</h5>
                    <p><?= $page->objective ?></p>
                </div>
                <?php if($page->outputs): ?>
                <div edit="outputs">
                    <h5 style="text-transform:uppercase">Outputs</h5>
                    <p><?= $page->outputs ?></p>
                </div>
                <?php endif; ?>
            </div>
            <div class="infos-one-work">
                <div edit="duration">
                    <h5 style="text-transform:uppercase">Duration</h5>
                    <p><?= $page->duration ?></p>
                </div>
                <div edit="donor">
                    <h5 style="text-transform:uppercase">Donor</h5>
                    <p><?= $page->donor ?></p>
                </div>
                <div edit="project_areas">
                    <h5 style="text-transform:uppercase">PROJECT AREAS</h5>
                    <p><?= $page->project_areas ?></p>
                </div>
                <div edit="budget">
                    <h5 style="text-transform:uppercase">BUDGET</h5>
                    <p><?= $page->budget ?></p>
                </div>
            </div>
        </div>
    </section>

    <?php include('./_footer.php'); ?>

</div>