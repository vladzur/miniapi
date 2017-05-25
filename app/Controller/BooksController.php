<?php
namespace Vladzur\MiniApi\Controller;

use League\Fractal;
use League\Fractal\Manager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vladzur\MiniApi\Controller;
use Vladzur\MiniApi\Model\Book;
use Vladzur\MiniApi\Transformer\BookTransformer;

class BooksController extends Controller
{

    public function index(Request $request, Response $response)
    {
        $books = Book::all();
        $fractal = new Manager();
        $resource = new Fractal\Resource\Collection($books, new BookTransformer);
        $response->withHeader('Content-type', 'application/json');
        $response->getBody()->write($fractal->createData($resource)->toJson());
        return $response;
    }

    public function store(Request $request, Response $response)
    {
        $params = $request->getParsedBody();
        $book = new Book;
        $book->title = $params['title'];
        $book->author = $params['author'];
        $book->ISBN = $params['ISBN'];
        $book->save();
        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($book, new BookTransformer);
        $response->withHeader('Content-type', 'application/json');
        $response->getBody()->write($fractal->createData($resource)->toJson());
        return $response;
    }
}
