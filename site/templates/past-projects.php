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
<section edit="projects_card" class="past-projects-area">

<?php foreach ($page->projects_card as $card): ?>
    <div  class="past-projects-card">
        <h4 edit="<?= $card ?>.title_past_project"><?= $card->title_past_project ?></h4>
        <h5 edit="<?= $card ?>.budget_past_project"><?= $card->budget_past_project ?></h5>
        <p class="body-bold">Duration:  <span edit="<?= $card ?>.duration_past_project"><?= $card->duration_past_project ?></span></p>
        <p class="body-bold">Target Districts: <span edit="<?= $card ?>.target_past_project"><?= $card->target_past_project ?></span></p>
        <p class="body-bold">Donor: <span edit="<?= $card ?>.donor_past_project"><?= $card->donor_past_project ?></span></p>
        <p class="body-bold">Beneficiaries Reached: <span edit="<?= $card ?>.beneficiaries_past_project"><?= $card->beneficiaries_past_project ?> </span></p>
    </div>

<?php endforeach; ?>

</section>
<?php include('./_footer.php'); ?>
</div>