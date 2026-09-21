<?php
namespace ProcessWire;


?>

<div id="content">
    <?php $donors = $pages->get('/donors/'); ?>
    <header>
        <?php include('./_nav.php'); ?>
    </header>
    <section data-nav-color="light">
        <div class="heading-left">
            <h1 edit="title"><?= $page->title ?></h1>
            <p edit="hero_description"><?= $page->hero_description ?: "Your gift reaches the women other systems leave behind. Women living with HIV. Survivors of violence. Women in Nepal's entertainment sector facing stigma every day. For twenty years, FAITH's outreach workers, counselors, and community paralegals have reached them — because people like you made it possible." ?></p>
        
            <a class="btn white" href="<?= $page->cta_url ?: $pages->get('/accountability/')->url ?>">
                <span edit="cta_label"><?= $page->cta_label ?: 'Check due diligence' ?></span>
                <img src="<?= $config->urls->templates ?>icons/arrow_forward.png" alt="icon">
            </a>
        </div>
    </section>
    <section class="bank-details" data-nav-color="light">
        <h3 edit="<?= $donors->id ?>:born_title"><?= $donors->born_title ?: 'Bank details' ?></h3>
        <ul>
            <li edit="<?= $donors->id ?>:card_number"><?= $donors->card_number ?: 'Account holder: FAITH Nepal' ?></li>
            <li edit="<?= $donors->id ?>:card_number2"><?= $donors->card_number2 ?: 'Account number: [XXXX]' ?></li>
            <li edit="<?= $donors->id ?>:card_number3"><?= $donors->card_number3 ?: 'SWIFT: [XXXX]' ?></li>
            <li edit="<?= $donors->id ?>:card_number4"><?= $donors->card_number4 ?: 'Bank: [Bank name and branch, Lalitpur]' ?></li>
            <li edit="<?= $donors->id ?>:card_title"><?= $donors->card_title ?: 'Reference: your email address (so we can thank you and send updates)' ?></li>
        </ul>
    </section>

    <?php include('./_footer.php'); ?>

</div>