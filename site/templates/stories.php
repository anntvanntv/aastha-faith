<?php namespace ProcessWire;



?>

<div id="content">
<header>
<?php include('./_nav.php'); ?>
        <section class="title-stories">
            <div class="eyebrow">
                <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                <h5>explore</h5>
            </div>
            <h1 edit="title"><?= $page->title ?></h1>
        </section>
    </header>
    <section class="container">

    <?php if($user->isLoggedin()): ?>
        <a href="<?= $config->urls->admin ?>page/add/?parent_id=<?= $page->id ?>" class="btn add-story-btn">
            Add New Story
        </a>
    <?php endif; ?>


    <?php foreach($page->children() as $story): ?> 
        <div class="news-card">
            <div class="ncard-picture bgw800">
            <img src="<?= $story->image->url ?>" alt="<?= $story->title ?>">
            </div>
            <div class="programme-title">
            <p class="small"><?= $story->category ?></p>
                <h5 class="date" style="text-transform: uppercase;"><?php echo strtoupper(date("F Y", $story->date)); ?></h5>
            </div>
            <div class="ncard-content">
                <div class="title-content">
                    <h4><?= $story->title ?></h4>
                    <p><?= substr(strip_tags($story->body), 0, 180) ?>...</p>
                </div>
                <div class="btn-content">
                    <a href="<?= $story->url ?>" class="btn emptyblack">
                        Read more
                        <img src="<?= $config->urls->templates ?>icons/arrow_forward.png" alt="icon_arrow">
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
       

    </section>

    <?php include('./_footer.php'); ?>
</div>