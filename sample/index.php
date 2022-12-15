<?php
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PugRenderer;

require '../vendor/autoload.php';

// Create Container using PHP-DI
$container = new Container();

// Set container to create App with on AppFactory
AppFactory::setContainer($container);
$app = AppFactory::create();
$app->setBasePath("/slim4-pug/sample"); // Change the base path depending on your implementation

$container->set('PugRenderer', function () {
    return new PugRenderer();
});


$app->get('/', function (Request $request, Response $response, $args) {
	$pugRenderer = $this->get('PugRenderer');

	return $pugRenderer->render($response, 'hello', ['name'=>'Alec']);
});

$app->run();
