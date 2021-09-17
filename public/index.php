<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = realpath(__DIR__ . '/') . $url['path'];
    if (is_file($file)) {
        return false;
    }
}
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require SOURCE_PATH . 'settings.php';

/** @var Slim\App $app */
$app = new Slim\App($settings);

// Set up dependencies
require SOURCE_PATH . 'dependencies.php';

// Register middleware
require SOURCE_PATH . 'middleware.php';

// Register routes
require SOURCE_PATH . 'routes.php';

// Run application
$app->run();
