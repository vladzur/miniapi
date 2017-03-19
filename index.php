<?php
require 'vendor/autoload.php';
use vladzur\miniapi\Controller\ApiController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$container = new League\Container\Container;

$container->share('response', Zend\Diactoros\Response::class);
$container->share('request', function () {
    return Zend\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
    );
});


$router = new League\Route\RouteCollection($container);

$router->get('/api/test', [new ApiController, 'test']);
$router->get('/api/index', [new ApiController, 'index']);

$router->dispatch($container->get('request'), $container->get('response'));
