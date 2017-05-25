<?php

//Dependency injector
$container = new League\Container\Container;

//Share injections of Request and Response
$container->share('response', Zend\Diactoros\Response::class);
$container->share('request', function () {
    return Zend\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
    );
});
//Share output class dependency
$container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);

//New Router object with dependencies
$router = new League\Route\RouteCollection($container);

//Setup Routes
$router->get('/api/books', [new BooksController, 'index']);
$router->post('/api/books', [new BooksController, 'store']);

//Dispatcher
$router->dispatch($container->get('request'), $container->get('response'));

//Output response
$container->get('emitter')->emit($container->get('response'));