<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));

// Check if we are on localhost
$GLOBALS['is_localhost'] = in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1')) ? true : false;

// Get the relative path to the application
$app_directory = $GLOBALS['is_localhost'] ? '' : '/laravel-ufarocks';

require __DIR__.'/..'.$app_directory.'/vendor/autoload.php';

$app = require_once __DIR__.'/..'.$app_directory.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
