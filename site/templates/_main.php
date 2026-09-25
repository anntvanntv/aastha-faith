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
	
$home = $pages->get('/'); /** @var HomePage $home */

?><!DOCTYPE html>
<html lang="en">
	<head id="html-head">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" http-equiv="content-type" content="text/html; charset=utf-8" />
		<title><?php echo $page->title; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates; ?>styles/main.css?v=<?= filemtime($config->paths->templates . 'styles/main.css') ?>" />
		<script src="<?php echo $config->urls->templates; ?>scripts/main.js?v=<?= filemtime($config->paths->templates . 'scripts/main.js') ?>"></script>
	</head>
	<body id="html-body" class="page-wrapper  <?= $page->template->name ?><?= $page->name === 'http404' ? ' page404' : '' ?>">
	

	<!--  -->
		
		<div id="content">
		default content
		</div>

		<script src="<?= $config->urls->templates ?>scripts/<?= $page->template->name ?>.js"></script>
	</body>
</html>