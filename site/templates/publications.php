<?php namespace ProcessWire;
?>

<div id="content">
<header>
<?php include('./_nav.php'); ?>
    <section class="title-publications">
        <div class="eyebrow">
            <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
            <h5 style="text-transform: uppercase;">Publications</h5>
        </div>
        <h1 edit="title"><?= $page->title ?></h1>
    </section>
</header>

<section class="container">
    <div class="publications-group">
        <h4 edit="publication_section1"><?= $page->publication_section1 ?: 'Digital Booklets' ?></h4>
        <div class="publications-cards" edit="booklet_cards">
            <?php foreach ($page->booklet_cards as $card): ?>
            <div class="publication-card">
                <?php if ($card->cover_image): ?>
                    <img class="cover" src="<?= $card->cover_image->url ?>" alt="<?= $card->title ?>">
                <?php endif; ?>
                <div class="publication-info">
                    <h4><?= $card->title ?></h4>
                </div>
                <a class="publication-download" href="<?= $card->pdf_file->url ?>" download>
                    Click to Download
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="publications-group">
        <h4 edit="publication_section2"><?= $page->publication_section2 ?: 'Case Studies and Research' ?></h4>
        <div class="publications-cards" edit="research_cards">
            <?php foreach ($page->research_cards as $card): ?>
            <div class="publication-card">
                <?php if ($card->cover_image): ?>
                    <img class="cover" src="<?= $card->cover_image->url ?>" alt="<?= $card->title ?>">
                <?php endif; ?>
                <div class="publication-info">
                    <h4><?= $card->title ?></h4>
                </div>
                <a class="publication-download" href="<?= $card->pdf_file->url ?>" download>
                    Click to Download
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include('./_footer.php'); ?>
</div>
