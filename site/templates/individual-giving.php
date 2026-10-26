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
    <section class="bank-details" data-nav-color="dark">
        <h3 edit="<?= $donors->id ?>:born_title"><?= $donors->born_title ?: 'Bank details' ?></h3>
        <div class="bank-card">
            <?php if ($donors->bank_logo): ?>
            <img class="bank-logo" edit="<?= $donors->id ?>:bank_logo" src="<?= $donors->bank_logo->url ?>" alt="<?= $donors->bank_logo->description ?: 'Bank logo' ?>">
            <?php endif; ?>
            <ul>
                <li edit="<?= $donors->id ?>:card_number"><?= $donors->card_number ?: 'Account holder: FAITH Nepal' ?></li>
                <li edit="<?= $donors->id ?>:card_number2"><?= $donors->card_number2 ?: 'Account number: [XXXX]' ?></li>
                <li edit="<?= $donors->id ?>:card_number3"><?= $donors->card_number3 ?: 'Account number: [XXXX]' ?></li>
                <li edit="<?= $donors->id ?>:card_number4"><?= $donors->card_number4 ?: 'Account number: [XXXX]' ?></li>
                <li edit="<?= $donors->id ?>:card_number5"><?= $donors->card_number5 ?: 'Account number: [XXXX]' ?></li>
                <li edit="<?= $donors->id ?>:card_number6"><?= $donors->card_number6 ?: 'Account number: [XXXX]' ?></li>
                <li edit="<?= $donors->id ?>:card_number7"><?= $donors->card_number7 ?: 'Account number: [XXXX]' ?></li>
            </ul>
            <ul>
                <li edit="<?= $donors->id ?>:card_number8"><?= $donors->card_number8 ?: 'SWIFT: [XXXX]' ?></li>
                <li edit="<?= $donors->id ?>:card_number9"><?= $donors->card_number9 ?: 'Bank: [Bank name and branch, Lalitpur]' ?></li>
                <li edit="<?= $donors->id ?>:card_title"><?= $donors->card_title ?: 'Reference: your email address (so we can thank you and send updates)' ?></li>
            </ul>
        </div>
    </section>

    <?php include('./_footer.php'); ?>

</div>