<?php

namespace App\Repositories;

use App\Book;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookDetailsResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\V2BookResource;
use App\Interfaces\BookInterface;
use App\Traits\ResponseApi;
use Illuminate\Http\Request;

class BookRepository implements BookInterface
{
    use ResponseApi;

    public function getBooks(Request $request)
    {
        $books = Book::paginate(15);
        //dd($books);

        if ($books === null) {
            return $this->error('Books not exists');
        }
        $response = V2BookResource::collection($books);

        return $this->success('List books', $response, 200);
    }

    public function createBook(Request $request)
    {
        $title = $request->title;
        $author = $request->author;

        $book = Book::create([
            'title' => $title,
            'author' => $author
        ]);

        $response = new BookDetailsResource($book);

        return $this->success('Book creates', $response, 200);
    }

    public function getBookDetails(Request $request)
    {
        $book_id = $request->id;

        $book = Book::find($book_id);

        if ($book === null) {
            return $this->error("Book ID $book_id not found");
        }

        $response = new V2BookResource($book);

        return $this->success('Book details', $response, 200);
    }

    public function updateBook(Request $request)
    {
        try {

            $request->validate([
                'title' => 'required',
                'author' => 'required'
            ]);

            $book_id = $request->id;

            $title = $request->title;
            $author = $request->author;

            $update = Book::where('id', $book_id)->update([
                'title' => $title,
                'author' => $author
            ]);

            if (!$update) {
                return $this->error('Update failed');
            }

            $response = Book::find($book_id);
            return $this->success('Book updated', $response, 200);
            //code...

        } catch (\Exception $e) {
            return $this->error($e->getMessage());
            //throw $th;
        }
    }

    public function deleteBook(Request $request)
    {
        $book_id = $request->id;

        $delete = Book::where('id', $book_id)->delete();

        if (!$delete){
            return $this->error('Delete book failed');
        }

        $book = Book::all();

        //$response = "$delete book deleted";
        return $this->success('Delete book success', $book, 200);

    }

    public function bookArchived(Request $request)
    {
        $archive_book = Book::onlyTrashed()->get();
        if (!$archive_book) {
            return $this->error('Book archived not found');
        }
        return $this->success('Books archived', $archive_book, 200);
    }
}
