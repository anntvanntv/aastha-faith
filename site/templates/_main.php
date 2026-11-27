<?php namespace ProcessWire;

// Optional main output file, called after rendering page’s template file. 
// This is defined by $config->appendTemplateFile in /site/config.php, and
// is typically used to define and output markup common among most pages.
// 	
// When the Markup Regions feature is used, template files can prepend, append,
// replace or delete any element defined here that has an "id" attribute. 
// https://processwire.com/docs/front-end/output/markup-regions/
	
/** @var Page $page */
/** @var Pages $pages */
/** @var Config $config */
/** @var Sanitizer $sanitizer */
	
$home = $pages->get('/'); /** @var HomePage $home */
$truncateNoticeText = static function (string $text, int $limit): string {
	$useGraphemes = function_exists('grapheme_strlen') && function_exists('grapheme_substr');
	$length = $useGraphemes ? grapheme_strlen($text) : mb_strlen($text, 'UTF-8');
	if ($length === false || $length <= $limit) return $text;

	$preview = $useGraphemes
		? grapheme_substr($text, 0, $limit - 1)
		: mb_substr($text, 0, $limit - 1, 'UTF-8');
	return rtrim((string) $preview) . '…';
};
$siteNoticeItems = [];
$siteNoticeSettings = $pages->get('/site-notices/');
if (
	$siteNoticeSettings->id
	&& $siteNoticeSettings->hasField('site_notices_enabled')
	&& $siteNoticeSettings->site_notices_enabled
) {
	foreach ($siteNoticeSettings->site_notice_cards as $noticeCard) {
		if (
			$noticeCard->site_notice_hidden
			|| trim((string) $noticeCard->site_notice_heading) === ''
			|| trim((string) $noticeCard->site_notice_body) === ''
		) continue;

		$siteNoticeItem = ['page' => $noticeCard, 'attachment' => null];
		$attachment = $noticeCard->site_notice_attachment;
		if ($attachment instanceof Pagefile && is_file($attachment->filename)) {
			$extension = strtolower($attachment->ext);
			$fileSize = filesize($attachment->filename);
			$fileMime = (new \finfo(FILEINFO_MIME_TYPE))->file($attachment->filename);
			$imageMimes = [
				'jpg' => 'image/jpeg',
				'jpeg' => 'image/jpeg',
				'png' => 'image/png',
				'webp' => 'image/webp',
			];
			$imageAlt = trim((string) $noticeCard->site_notice_image_alt);

			if (
				isset($imageMimes[$extension])
				&& $fileMime === $imageMimes[$extension]
				&& $fileSize !== false
				&& $fileSize <= 5000000
			) {
				$siteNoticeItem['attachment'] = [
					'type' => 'image',
					'url' => $attachment->url,
					'alt' => $imageAlt !== '' ? $imageAlt : trim((string) $noticeCard->site_notice_heading),
				];
			} elseif (
				$extension === 'pdf'
				&& $fileMime === 'application/pdf'
				&& $fileSize !== false
				&& $fileSize <= 10000000
			) {
				$siteNoticeItem['attachment'] = [
					'type' => 'pdf',
					'url' => $attachment->url,
					'alt' => '',
				];
			}
		}

		$siteNoticeItems[] = $siteNoticeItem;
	}

	if (!$siteNoticeSettings->site_notices_manual_order) {
		usort($siteNoticeItems, static function (array $a, array $b): int {
			return ($b['page']->created <=> $a['page']->created)
				?: ($b['page']->id <=> $a['page']->id);
		});
	}

	$countValue = $siteNoticeSettings->site_notices_count;
	$noticeLimit = ($countValue === '' || $countValue === null) ? 1 : max(0, (int) $countValue);
	$siteNoticeItems = array_slice($siteNoticeItems, 0, min($noticeLimit, count($siteNoticeItems)));
}
$siteNoticeSignature = hash('sha256', implode('|', array_map(
	static function (array $item): string {
		return $item['page']->id . ':' . $item['page']->modified;
	},
	$siteNoticeItems
)));

?><!DOCTYPE html>
<html lang="en">
	<head id="html-head">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" http-equiv="content-type" content="text/html; charset=utf-8" />
		<title><?php echo $page->title; ?></title>
		<?php $favicon = $pages->get('/footer/')->site_favicon; // set in admin: Pages → Footer → Favicon
		if ($favicon):
			$v = $favicon->modified;
			if ($favicon->ext === 'svg'): ?>
		<link rel="icon" type="image/svg+xml" href="<?= $favicon->url ?>?v=<?= $v ?>" />
		<?php else: ?>
		<link rel="icon" type="image/png" sizes="32x32" href="<?= $favicon->size(32, 32)->url ?>?v=<?= $v ?>" />
		<link rel="apple-touch-icon" sizes="180x180" href="<?= $favicon->size(180, 180)->url ?>?v=<?= $v ?>" />
		<?php endif; endif; ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates; ?>styles/main.css?v=<?= filemtime($config->paths->templates . 'styles/main.css') ?>" />
		<script src="<?php echo $config->urls->templates; ?>scripts/main.js?v=<?= filemtime($config->paths->templates . 'scripts/main.js') ?>"></script>
	</head>
	<body id="html-body" class="page-wrapper  <?= $page->template->name ?><?= $page->name === 'http404' ? ' page404' : '' ?>">
	

	<!--  -->
		
		<div id="content">
		default content
		</div>

		<script src="<?= $config->urls->templates ?>scripts/<?= $page->template->name ?>.js"></script>
		<?php if ($siteNoticeItems): ?>
		<dialog id="site-notice-dialog" class="site-notice-dialog" aria-labelledby="site-notice-title-0" data-notice-signature="<?= $sanitizer->entities($siteNoticeSignature) ?>">
			<div class="site-notice-panel">
				<button class="site-notice-close" type="button" data-notice-close aria-label="Close notice">Close <span aria-hidden="true">&times;</span></button>
				<div class="site-notice-cards">
					<?php foreach ($siteNoticeItems as $index => $item):
						$notice = $item['page'];
						$noticeHeading = $truncateNoticeText(trim((string) $notice->site_notice_heading), 100);
						$noticeBody = $truncateNoticeText(trim((string) $notice->site_notice_body), 200); ?>
					<article class="site-notice-card" data-notice-card<?= $index > 0 ? ' hidden' : '' ?>>
						<h2 id="site-notice-title-<?= $index ?>"><?= $sanitizer->entities($noticeHeading) ?></h2>
						<div class="site-notice-body"><?= nl2br($sanitizer->entities($noticeBody)) ?></div>
						<?php if ($item['attachment'] && $item['attachment']['type'] === 'image'): ?>
						<img class="site-notice-image" src="<?= $sanitizer->entities($item['attachment']['url']) ?>" alt="<?= $sanitizer->entities($item['attachment']['alt']) ?>" />
						<?php elseif ($item['attachment'] && $item['attachment']['type'] === 'pdf'): ?>
						<div class="site-notice-pdf-preview" data-pdf-preview data-pdf-url="<?= $sanitizer->entities($item['attachment']['url']) ?>">
							<div class="site-notice-pdf-thumbnails" data-pdf-thumbnails id="site-notice-pdf-thumbnails-<?= $index ?>" hidden></div>
							<div class="site-notice-pdf-main">
								<div class="site-notice-pdf-page" data-pdf-page>
									<canvas data-pdf-canvas role="img" aria-label="PDF page preview"></canvas>
								</div>
								<div class="site-notice-pdf-controls" role="group" aria-label="PDF page controls">
									<button class="site-notice-pdf-button" type="button" data-pdf-previous disabled>Previous</button>
									<span class="site-notice-pdf-status" data-pdf-status aria-live="polite">Loading PDF preview…</span>
									<button class="site-notice-pdf-button" type="button" data-pdf-next disabled>Next</button>
									<button class="site-notice-pdf-button" type="button" data-pdf-thumbnails-toggle aria-controls="site-notice-pdf-thumbnails-<?= $index ?>" aria-expanded="false" disabled>Show pages</button>
								</div>
							</div>
						</div>
						<a class="site-notice-pdf" href="<?= $sanitizer->entities($item['attachment']['url']) ?>" target="_blank" rel="noopener noreferrer">Open or download the full PDF</a>
						<?php endif; ?>
					</article>
					<?php endforeach; ?>
				</div>
			</div>
		</dialog>
		<script type="module" src="<?= $config->urls->templates ?>scripts/site-notices.js?v=<?= filemtime($config->paths->templates . 'scripts/site-notices.js') ?>"></script>
		<?php endif; ?>
	</body>
</html>