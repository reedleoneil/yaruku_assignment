<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getBooks()
    {
        return new BookResource($this->bookRepository->getBooks());
    }

    public function getBook(Request $request)
    {
      $book = $this->newBook($request);
      return new BookResource($this->bookRepository->getBook($book));
    }

    public function insertBook(Request $request)
    {
      $book = $this->newBook($request);
      return new BookResource($this->bookRepository->insertBook($book));
    }

    public function updateBook(Request $request)
    {
      $book = $this->newBook($request);
      return new BookResource($this->bookRepository->updateBook($book));
    }

    public function deleteBook(Request $request)
    {
      $book = $this->newBook($request);
      return new BookResource($this->bookRepository->deleteBook($book));
    }

    private function newBook($request)
    {
      $book = new Book();
      $book->id = $request->input('id');
      $book->title = $request->input('title');
      $book->author = $request->input('author');
      return $book;
    }
}
