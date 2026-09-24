<?php
namespace ProcessWire;



?>

<div id="content">
<?php include('./_nav.php'); ?>
<section class="header-central"><h2 edit="hero_title1"><?= $page->hero_title1 ?></h2></section>
<section class="past-projects-links">
    <ul>
        <li>
            <a href="<?= $pages->get('/our-work/')->url ?>">Ongoing</a>
        </li>
        <li>
            <a href="<?= $page->url ?>" class="active">Past</a>
        </li>
    </ul>
</section>
<?php
$visibleCards = $page->projects_card->slice(0, 6);
$extraCards = iterator_to_array($page->projects_card->slice(6));
$extraBatches = array_chunk($extraCards, 6);
?>
<section edit="projects_card" class="past-projects-area">

<?php foreach ($visibleCards as $card): ?>
    <div  class="past-projects-card">
        <h4 edit="<?= $card ?>.title_past_project"><?= $card->title_past_project ?></h4>
        <h5 edit="<?= $card ?>.budget_past_project"><?= $card->budget_past_project ?></h5>
        <p class="body-bold">Duration:  <span edit="<?= $card ?>.duration_past_project"><?= $card->duration_past_project ?></span></p>
        <?php if (trim($card->target_past_project)): ?>
        <p class="body-bold">Target Districts: <span edit="<?= $card ?>.target_past_project"><?= $card->target_past_project ?></span></p>
        <?php endif; ?>
        <p class="body-bold">Donor: <span edit="<?= $card ?>.donor_past_project"><?= $card->donor_past_project ?></span></p>
        <p class="body-bold">Reflection: <span edit="<?= $card ?>.beneficiaries_past_project"><?= $card->beneficiaries_past_project ?> </span></p>
    </div>

<?php endforeach; ?>

</section>

<?php foreach ($extraBatches as $batch): ?>
<div class="more-cards">
    <section class="past-projects-area">
    <?php foreach ($batch as $card): ?>
        <div  class="past-projects-card">
            <h4 edit="<?= $card ?>.title_past_project"><?= $card->title_past_project ?></h4>
            <h5 edit="<?= $card ?>.budget_past_project"><?= $card->budget_past_project ?></h5>
            <p class="body-bold">Duration:  <span edit="<?= $card ?>.duration_past_project"><?= $card->duration_past_project ?></span></p>
            <?php if (trim($card->target_past_project)): ?>
            <p class="body-bold">Target Districts: <span edit="<?= $card ?>.target_past_project"><?= $card->target_past_project ?></span></p>
            <?php endif; ?>
            <p class="body-bold">Donor: <span edit="<?= $card ?>.donor_past_project"><?= $card->donor_past_project ?></span></p>
            <p class="body-bold">Reflection: <span edit="<?= $card ?>.beneficiaries_past_project"><?= $card->beneficiaries_past_project ?> </span></p>
        </div>
    <?php endforeach; ?>
    </section>
</div>
<?php endforeach; ?>

<?php if (count($extraBatches)): ?>
<button class="expand-cards-btn" id="expandCardsBtn">
    <span class="expand-cards-label" id="expandCardsLabel">See More</span>
    <svg class="expand-cards-arrow" width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M1 1L7 7L13 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</button>
<?php endif; ?>
<?php include('./_footer.php'); ?>
</div>
