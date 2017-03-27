<?php namespace vladzur\miniapi\Transformer;

use vladzur\miniapi\Model\Book;
use League\Fractal;

class BookTransformer extends Fractal\TransformerAbstract
{
    public function transform(Book $book)
    {
        return [
            'id'      => (int) $book->id,
            'title'   => $book->title,
            'ISBN'    => $book->ISBN,
            'author'   => [
                [
                    'name' => $book->author,
                ]
            ],
        ];
    }
}
