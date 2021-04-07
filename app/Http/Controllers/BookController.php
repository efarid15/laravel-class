<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Interfaces\BookInterface;
use App\Traits\ResponseApi;

class BookController extends Controller
{

    use ResponseApi;
    protected $bookInterface;

    public function __construct(BookInterface $bookInterface)
    {
        $this->bookInterface = $bookInterface;
    }

    public function getBooks(Request $request)
    {
        return $this->bookInterface->getBooks($request);
    }

    public function createBook(Request $request)
    {
        return $this->bookInterface->createBook($request);
    }

    public function getBookDetails(Request $request)
    {
        return $this->bookInterface->getBookDetails($request);
    }

    public function updateBook(Request $request)
    {
        return $this->bookInterface->updateBook($request);
    }

    public function deleteBook(Request $request)
    {
        return $this->bookInterface->deleteBook($request);
    }

    public function bookArchived(Request $request)
    {
        return $this->bookInterface->bookArchived($request);
    }
}
