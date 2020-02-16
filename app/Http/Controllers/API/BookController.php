<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\API\Response;

class BookController extends Controller
{
  protected $bookRepository;

  public function __construct(BookRepository $bookRepository)
  {
    $this->bookRepository = $bookRepository;
  }

  public function getBooks()
  {
    try
    {
      $data = BookResource::collection($this->bookRepository->getBooks());
      return Response::success($data);
    }
    catch(Exception $e)
    {
      return Response::failed($e);
    }
  }

  public function getBook(Request $request)
  {
    try
    {
      $data = new BookResource($this->bookRepository->getBook($book));
      return Response::success($data);
    }
    catch(Exception $e)
    {
      return Response::failed($e);
    }
  }

  public function insertBook(Request $request)
  {
    try
    {
      $book = $this->mapRequestInputToBook($request);
      $data = new BookResource($this->bookRepository->insertBook($book));
      return Response::success($data);
    }
    catch(Exception $e)
    {
      return Response::failed($e);
    }
  }

  public function updateBook(Request $request)
  {
    try
    {
      $book = $this->mapRequestInputToBook($request);
      $data = new BookResource($this->bookRepository->updateBook($book));
      return Response::success($data, 'book updated');
    }
    catch(Exception $e)
    {
      return Response::failed($e);
    }
  }

  public function deleteBook(Request $request)
  {
    try
    {
      $book = $this->mapRequestInputToBook($request);
      $data = new BookResource($this->bookRepository->deleteBook($book));
      return Response::success($data, 'book deleted');
    }
    catch(Exception $e)
    {
      return Response::failed($e);
    }
  }

  private function mapRequestInputToBook($request)
  {
    $book = new Book();
    $book->id = $request->input('id');
    $book->title = $request->input('title');
    $book->author = $request->input('author');
    return $book;
  }
}
