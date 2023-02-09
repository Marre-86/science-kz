<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use DI\Container;

if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

$container = new Container();
$container->set('renderer', function () {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});

$app = AppFactory::setContainer($container);
$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

$router = $app->getRouteCollector()->getRouteParser();

echo "Hello science!";

$app->get('/', function ($request, $response) {
    $params = ['greeting' => 'Путин хуйло'];
    return $this->get('renderer')->render($response, 'main.phtml', $params);
})->setName('main');

$app->run();
