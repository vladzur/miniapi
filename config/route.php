<?php
$container = new League\Container\Container;
$container->share('response', Zend\Diactoros\Response::class);
$container->share('request', function () {
    return Zend\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
    );
});
$container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);

//----------------------------------------------
// New router
$router = new League\Route\RouteCollection($container);
//----------------------------------------------
// Setup routes
//----------------------[ROUTES]----------------

$router->get('/', function(){
    return "Hola Mundo";
});
$router->get('/api/books', 'Vladzur\MiniApi\Controller\BooksController::index');
$router->post('/api/books', 'Vladzur\MiniApi\Controller\BooksController::store');

//----------------------[END]-------------------

//----------------------------------------------
// Dispatch
//----------------------------------------------
$router->dispatch($container->get('request'), $container->get('response'));
$container->get('emitter')->emit($container->get('response'));
