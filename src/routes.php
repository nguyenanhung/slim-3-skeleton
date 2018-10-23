<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message

    $this->logger->info("Slim-Skeleton '/' route" . json_encode($request->getQueryParams()));

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->group('', function () use ($app) {
    $app->get('/app/test', App\AppController::class . ':test');
});