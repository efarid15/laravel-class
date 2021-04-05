<?php

namespace App\Repositories;

use App\Book;
use App\Interfaces\BookInterface;
use App\Traits\ResponseApi;
use Illuminate\Http\Request;

class BookRepository implements BookInterface
{
    use ResponseApi;

    public function getBooks(Request $request)
    {
        $books = Book::All();
        if ($books == null) {
            return $this->error('Books not exists');
        }

        return $this->success('List books', $books, 200);

    }

    public function createBook(Request $request) {
        $title = $request->title;
        $author = $request->author;

        $book = Book::create([
            'title' => $title,
            'author' => $author
        ]);

        return $this->success('Book creates', $book, 200);
    }
}
