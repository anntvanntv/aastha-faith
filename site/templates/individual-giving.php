<?php
namespace ProcessWire;


?>

<div id="content">
    <header>
        <?php include('./_nav.php'); ?>
    </header>
    <section>
        <div class="heading-left">
            <h1 edit="title"><?= $page->title ?></h1>
            <p edit="hero_description"><?= $page->hero_description ?> Your gift reaches the women other systems leave behind. Women living with HIV. Survivors of violence.
                Women in Nepal's entertainment sector acing stigma every day. For twenty years, FAITH's outreach
                workers, counselors, and community paralegals have reached them — because people like you made it
                possible.</p>
        
            <a class="btn white" href="<?= $pages->get('/accountability/')->url ?>">
                Check due diligence
                <img src="<?= $config->urls->templates ?>icons/arrow_forward.png" alt="icon">
            </a>
        </div>
    </section>
    <section class="bank-details">
        <h3 edit="born_title"><?= $page->born_title ?> Bank details</h3>
        <ul>
            <li edit="card_number"><?= $page->card_number ?> Account holder: FAITH Nepal</li>
            <li edit="card_number2"><?= $page->card_number2 ?> Account number: [XXXX]</li>
            <li edit="card_number3"><?= $page->card_number3 ?> SWIFT: [XXXX]</li>
            <li edit="card_number4"><?= $page->card_number4 ?>Bank: [Bank name and branch, Lalitpur]</li>
            <li edit="card_title"><?= $page->card_card_title ?>Reference: your email address (so we can thank you and send updates)</li>
        </ul>
    </section>

    <?php include('./_footer.php'); ?>

</div>