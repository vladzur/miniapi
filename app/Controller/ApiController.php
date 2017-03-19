<?php
namespace vladzur\miniapi\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ApiController
{

    public function test(Request $request, Response $response)
    {
        echo json_encode($_SERVER);
    }

    public function index(Request $request, Response $response)
    {
        echo "<h1>Index</h1>";
        echo "<pre>";
        var_dump($request);
        echo "</pre>";
    }
}
