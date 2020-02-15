<?php

namespace App\DataStores;

use App\Models\Book;

class BookDataStore
{
  public function getBooks()
  {
    return Book::all();
  }

  public function getBook(Book $book)
  {
    return Book::where('title', 'like', '%'.$book->title.'%')
               ->where('author', 'like', '%'.$book->author.'%')
               ->get();
  }

  public function insertBook(Book $book)
  {
    $book->save();
    $book->refresh();
    return $book;
  }

  public function updateBook(Book $book)
  {
    $title = $book->title;
    $author = $book->author;
    $book = Book::find($book->id);
    $book->title = $title;
    $book->author = $author;
    $book->save();
    $book->refresh();
    return $book;
  }

  public function deleteBook(Book $book)
  {
    $book = Book::find($book->id);
    $book->delete();
    $book->refresh();
    return $book;
  }
}
