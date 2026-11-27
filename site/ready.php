<?php namespace ProcessWire;

if(!defined("PROCESSWIRE")) die();

/** @var ProcessWire $wire */

/**
 * ProcessWire Bootstrap API Ready
 * ===============================
 * This ready.php file is called during ProcessWire bootstrap initialization process.
 * This occurs after the current page has been determined and the API is fully ready
 * to use, but before the current page has started rendering. This file receives a
 * copy of all ProcessWire API variables.
 *
 */



// ---------------------------------------------------------------------------------------------
// Runtime code — runs on every request
// ---------------------------------------------------------------------------------------------

// admin: submissions table is view-only — hide Add New and row delete
$isAdminReq = ($page && $page->template && $page->template->name === 'admin')
    || strpos($_SERVER['REQUEST_URI'] ?? '', $config->urls->admin) === 0;
if ($isAdminReq) {
    $config->styles->add($config->urls->templates . 'styles/admin.css');
    $wire->addHookBefore('InputfieldFile::processInput', function (HookEvent $event) {
        $inputfield = $event->object;
        $field = $inputfield->hasField;
        if (!$field || $field->name !== 'site_notice_attachment') return;

        // admin uploads are AJAX (filename in X-FILENAME header); plain form posts use $_FILES (name is an array)
        $upload = $_FILES[$inputfield->attr('name')]['name'] ?? null;
        $filename = $upload !== null
            ? (string) (is_array($upload) ? reset($upload) : $upload)
            : rawurldecode((string) ($_SERVER['HTTP_X_FILENAME'] ?? ''));
        if ($filename === '') return;

        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $inputfield->maxFilesize = $extension === 'pdf' ? 10000000 : 5000000;
    });
}

// onenews: default empty date to created timestamp (editors can still override)
$wire->addHookAfter('Pages::saved', function ($event) {
    $p = $event->arguments(0);
    if ($p->template->name !== 'onenews' || $p->date) return;
    $p->of(false);
    $p->date = $p->created ?: time();
    $p->save('date');
});

// ---------------------------------------------------------------------------------------------
// One-time site setup — see migrations.php
//
// The setup (RockMigrations fields/templates/pages + seeds) used to run on EVERY request:
// ~1,500 queries incl. ~400 writes per page view. It now runs only when migrations.php or the
// ProcessWire / RockMigrations version changes (i.e. once after a deploy), on the first
// front-end request — the same context it always ran in. A file lock prevents two requests
// running it at once; on failure it is logged and retried on the next request.
// ---------------------------------------------------------------------------------------------

$migrationsFile = __DIR__ . '/migrations.php';
$migrationsKey  = md5_file($migrationsFile) . '|' . $config->version . '|' . $modules->getModuleInfoProperty('RockMigrations', 'version');
if (!$isAdminReq && $cache->get('site-migrations-key') !== $migrationsKey) {
    $migrationsLock = fopen($config->paths->cache . 'site-migrations.lock', 'c');
    if ($migrationsLock && flock($migrationsLock, LOCK_EX | LOCK_NB)) {
        try {
            include $migrationsFile;
            $cache->save('site-migrations-key', $migrationsKey, WireCache::expireNever);
            $log->save('site-migrations', 'ran ' . substr($migrationsKey, 0, 12));
        } catch (\Throwable $e) {
            $log->error('site migrations failed (will retry): ' . $e->getMessage());
        } finally {
            flock($migrationsLock, LOCK_UN);
        }
    }
    if ($migrationsLock) fclose($migrationsLock);
}
