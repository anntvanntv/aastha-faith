<?php
namespace ProcessWire;


?>

<div id="content">
    <header>
    <?php include('./_nav.php'); ?>
    </header>
    <section>
        <div class="header-central">
            <h1>However you give, you'll know exactly where it goes.</h1>
            <p>Since 2005, FAITH has been led by the women it serves. 72% of every contribution goes directly to programme delivery — and every document that proves it is on this page, free to download, no registration,
            no phone call required.</p>
        </div>
    </section>
    <section class="donors-section">
        <div class="header-section">
            <h3>Choose your path</h3>
            <?php if($user->isLoggedin() && !$page->donor_cards->count()): ?>
                <button edit="donor_cards">double-click to add a card</button>
            <?php endif; ?>
        </div>
        <div class="card-section-donors">
          <?php if($page->donor_cards->count()): ?>
            <?php foreach($page->donor_cards as $card): ?>
          <a class="vertical-card-link" href="<?= $card->donor_card_url ?: $pages->get('/donors/')->url ?>" edit="donor_cards">
            <div class="vertical-card">
                <div class="icon">
                    <img src="<?= $card->donor_card_icon ? $card->donor_card_icon->url : $config->urls->templates . 'icons/cor.png' ?>" alt="icon">
                </div>
                <h4><?= $card->donor_card_title ?></h4>
                <p><?= $card->donor_card_text ?></p>
            </div>
          </a>
            <?php endforeach; ?>
          <?php else: ?>
          <a class="vertical-card-link" href="<?= $pages->get('/donors/individual-giving/')->url ?>">
            <div class="vertical-card">
                <div class="icon">
                    <img src="<?= $config->urls->templates ?>icons/cor.png" alt="icon">
                </div>
                <h4>Individual giving</h4>
                <p>Make a direct impact with a one-time or recurring donation.</p>
            </div>
          </a>
          <a class="vertical-card-link" href="<?= $pages->get('/donors/institutional-funders/')->url ?>">
            <div class="vertical-card">
                <div class="icon">
                    <img src="<?= $config->urls->templates ?>icons/cor.png" alt="icon">
                </div>
                <h4>Institutional & technical funders</h4>
                <p>Partner with us to deliver sustainable, community-led programmes.</p>
            </div>
          </a>
          <a class="vertical-card-link" href="<?= $pages->get('/donors/philanthropists/')->url ?>">
            <div class="vertical-card">
                <div class="icon">
                    <img src="<?= $config->urls->templates ?>icons/cor.png" alt="icon">
                </div>
                <h4>For philanthropists</h4>
                <p>Support long-term initiatives that create lasting change.</p>
            </div>
          </a>
          <?php endif; ?>
             
        </div>
    </section>
    <?php include('./_footer.php'); ?>

</div>