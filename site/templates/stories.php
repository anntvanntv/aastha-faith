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
    <?php
    $visibleStories = $page->children()->slice(0, 6);
    $extraBatches = array_chunk(iterator_to_array($page->children()->slice(6)), 6);
    ?>
    <section class="container">

    <?php if($user->isLoggedin()): ?>
        <a href="<?= $config->urls->admin ?>page/add/?parent_id=<?= $page->id ?>" class="btn add-story-btn">
            Add New Story
        </a>
    <?php endif; ?>


    <?php foreach($visibleStories as $story): ?>
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

    <?php foreach ($extraBatches as $batch): ?>
    <div class="more-cards">
        <section class="container">
        <?php foreach($batch as $story): ?>
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