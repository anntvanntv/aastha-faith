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
            <div class="publication-card" data-pdf="<?= $card->pdf_file->url ?>">
                <?php if ($card->cover_image): ?>
                    <img class="cover" src="<?= $card->cover_image->url ?>" alt="<?= $card->title ?>">
                <?php endif; ?>
                <div class="publication-info">
                    <h4><img class="doc-icon" src="<?= $config->urls->templates ?>icons/pdf.png" alt="icon"><?= $card->title ?></h4>
                </div>
                <a class="publication-download" href="<?= $card->pdf_file->url ?>" download>
                    <svg class="dl-icon" viewBox="0 0 24 24"><line x1="12" y1="4" x2="12" y2="15"/><polyline points="7 11 12 16 17 11"/><line x1="5" y1="20" x2="19" y2="20"/></svg>Click to Download
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="publications-group">
        <h4 edit="publication_section2"><?= $page->publication_section2 ?: 'Case Studies and Research' ?></h4>
        <div class="publications-cards" edit="research_cards">
            <?php foreach ($page->research_cards as $card): ?>
            <div class="publication-card" data-pdf="<?= $card->pdf_file->url ?>">
                <?php if ($card->cover_image): ?>
                    <img class="cover" src="<?= $card->cover_image->url ?>" alt="<?= $card->title ?>">
                <?php endif; ?>
                <div class="publication-info">
                    <h4><img class="doc-icon" src="<?= $config->urls->templates ?>icons/pdf.png" alt="icon"><?= $card->title ?></h4>
                </div>
                <a class="publication-download" href="<?= $card->pdf_file->url ?>" download>
                    <svg class="dl-icon" viewBox="0 0 24 24"><line x1="12" y1="4" x2="12" y2="15"/><polyline points="7 11 12 16 17 11"/><line x1="5" y1="20" x2="19" y2="20"/></svg>Click to Download
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div class="pdf-viewer" hidden>
    <div class="pdf-viewer-backdrop"></div>
    <div class="pdf-viewer-modal">
        <span class="pdf-viewer-title"></span>
        <button type="button" class="pdf-viewer-close" aria-label="Close" title="Close"><svg viewBox="0 0 24 24"><line x1="6" y1="6" x2="18" y2="18"/><line x1="18" y1="6" x2="6" y2="18"/></svg></button>
        <div class="pdf-thumbs-panel">
            <div class="pdf-thumbs-title">Thumbnails</div>
            <div class="pdf-thumbs"></div>
        </div>
        <div class="pdf-viewer-stage">
            <div class="pdf-book"></div>
            <div class="pdf-viewer-loading"><span>Loading PDF…</span></div>
        </div>
        <button type="button" class="pdf-nav pdf-prev" aria-label="Previous page" title="Previous page"><svg viewBox="0 0 24 24"><polyline points="15 5 8 12 15 19"/></svg></button>
        <button type="button" class="pdf-nav pdf-next" aria-label="Next page" title="Next page"><svg viewBox="0 0 24 24"><polyline points="9 5 16 12 9 19"/></svg></button>
        <div class="pdf-controls">
            <span class="pdf-ctrl pdf-page-info"><input type="text" class="pdf-page-input" aria-label="Page number"></span>
            <button type="button" class="pdf-ctrl pdf-thumbs-toggle" aria-label="Toggle thumbnails" title="Toggle Thumbnails"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="8" height="8" rx="1"/><rect x="13" y="3" width="8" height="8" rx="1"/><rect x="3" y="13" width="8" height="8" rx="1"/><rect x="13" y="13" width="8" height="8" rx="1"/></svg></button>
            <button type="button" class="pdf-ctrl pdf-zoom-in" aria-label="Zoom in" title="Zoom In"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><line x1="8" y1="11" x2="14" y2="11"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="16.2" y1="16.2" x2="21" y2="21"/></svg></button>
            <button type="button" class="pdf-ctrl pdf-zoom-out" aria-label="Zoom out" title="Zoom Out"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><line x1="8" y1="11" x2="14" y2="11"/><line x1="16.2" y1="16.2" x2="21" y2="21"/></svg></button>
            <button type="button" class="pdf-ctrl pdf-fullscreen" aria-label="Fullscreen" title="Toggle Fullscreen"><svg viewBox="0 0 24 24"><polyline points="15 3 21 3 21 9"/><polyline points="9 21 3 21 3 15"/><line x1="21" y1="3" x2="14" y2="10"/><line x1="3" y1="21" x2="10" y2="14"/></svg></button>
            <button type="button" class="pdf-ctrl pdf-share" aria-label="Share" title="Share"><svg viewBox="0 0 24 24"><circle cx="6" cy="12" r="2.5"/><circle cx="18" cy="6" r="2.5"/><circle cx="18" cy="18" r="2.5"/><line x1="8.2" y1="10.8" x2="15.8" y2="7.2"/><line x1="8.2" y1="13.2" x2="15.8" y2="16.8"/></svg></button>
            <div class="pdf-more">
                <button type="button" class="pdf-ctrl pdf-more-toggle" aria-label="More options" title="More"><svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="1.6" fill="currentColor" stroke="none"/><circle cx="12" cy="12" r="1.6" fill="currentColor" stroke="none"/><circle cx="12" cy="19" r="1.6" fill="currentColor" stroke="none"/></svg></button>
                <div class="pdf-more-menu" hidden>
                    <a class="pdf-ctrl pdf-viewer-download" href="#" download title="Download PDF File"><svg viewBox="0 0 24 24"><line x1="12" y1="4" x2="12" y2="15"/><polyline points="7 11 12 16 17 11"/><line x1="5" y1="20" x2="19" y2="20"/></svg></a>
                    <button type="button" class="pdf-ctrl pdf-first" aria-label="First page" title="Goto First Page"><svg viewBox="0 0 24 24"><rect x="5" y="6" width="2.5" height="12" fill="currentColor" stroke="none"/><polygon points="18 6 10 12 18 18" fill="currentColor" stroke="none"/></svg></button>
                    <button type="button" class="pdf-ctrl pdf-last" aria-label="Last page" title="Goto Last Page"><svg viewBox="0 0 24 24"><rect x="16.5" y="6" width="2.5" height="12" fill="currentColor" stroke="none"/><polygon points="6 6 14 12 6 18" fill="currentColor" stroke="none"/></svg></button>
                    <button type="button" class="pdf-ctrl pdf-sound" aria-label="Toggle sound" title="Turn on/off Sound"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('./_footer.php'); ?>
</div>
