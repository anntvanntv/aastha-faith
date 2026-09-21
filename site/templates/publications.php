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
    <?php
    $types = [
        1 => 'Annual Reports',
        2 => 'Financial Statements',
        3 => 'Policy Documents',
    ];
    foreach ($types as $id => $label):
        $cards = $page->pdf_cards->find("info_type=$id");
        if ($cards->count()):
    ?>
    <div class="publications-group">
        <h4><?= $label ?></h4>
        <div class="horizontal-cards">
            <?php foreach ($cards as $card): ?>
            <div class="horizontal-card" edit="pdf_cards" data-pdf='<?= $card->pdf_file->url ?>'>
                <div class="card-left">
                    <div class="icon pdf">
                        <img src="<?= $config->urls->templates ?>/icons/pdf.png" alt="icon">
                    </div>
                    <div class="text-card">
                        <p edit='title' class="body-bold"><?= $card->title ?></p>
                        <p class="small">PDF</p>
                    </div>
                </div>
                <div class="icon download">
                    <a href="<?= $card->pdf_file->url ?>" download>
                        <img src="<?= $config->urls->templates ?>/icons/file_download.png" alt="icon">
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; endforeach; ?>
</section>

<?php include('./_footer.php'); ?>
</div>
