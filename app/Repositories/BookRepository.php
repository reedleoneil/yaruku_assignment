<?php

namespace App\Repositories;

use App\DataStores\BookDataStore;
use App\Models\Book;

class BookRepository
{
    protected $bookDataStore;

    public function __construct(BookDataStore $bookDataStore)
    {
        $this->bookDataStore = $bookDataStore;
    }

    public function getBooks()
    {
      return $this->bookDataStore->getBooks();
    }

    public function getBook(Book $book)
    {
      return $this->bookDataStore->getBook($book);
    }

    public function insertBook(Book $book)
    {
      return $this->bookDataStore->insertBook($book);
    }

    public function updateBook(Book $book)
    {
      return $this->bookDataStore->updateBook($book);
    }

    public function deleteBook(Book $book)
    {
      return $this->bookDataStore->deleteBook($book);
    }
}
