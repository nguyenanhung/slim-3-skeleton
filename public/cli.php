<?php
/**
 * Project slim-3-skeleton.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/23/18
 * Time: 22:24
 */
require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Commands\DemoCommand;

$demoCommand = new DemoCommand();

/** @var object $app */
$app = new Application();

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Register command
$app->add($demoCommand);

// Run application
$app->run();
