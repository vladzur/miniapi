<?php
namespace vladzur\miniapi\Controller;

use vladzur\miniapi\Model\Book;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BooksController
{

    public function index(Request $request, Response $response)
    {
        $books = Book::all();
        $response->withHeader('Content-Type', 'text/plain');
        $response->getBody()->write(json_encode($books));
        return $response;
    }

    public function store(Request $request, Response $response)
    {
        $book = new Book;
        $book->title = $_REQUEST['title'];
        $book->author = $_REQUEST['author'];
        $book->ISBN = $_REQUEST['ISBN'];
        $book->save();
        $response->withHeader('Content-Type', 'text/plain');
        $response->getBody()->write(json_encode($book));
        return $response;
    }
}
