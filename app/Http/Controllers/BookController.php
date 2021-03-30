<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Traits\ResponseApi;

class BookController extends Controller
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

    public function createBook(Request $request)
    {
        $title = $request->title;
        $author = $request->author;

        $book = Book::create([
            'title' => $title,
            'author' => $author
        ]);

        return $this->success('Book creates', $book, 200);
    }
}
