<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookExport implements FromQuery, WithMapping, WithHeadings
{
  use Exportable;

  protected $withHeaders;
  protected $withTitle;
  protected $withAuthor;

  public function query()
  {
    return Book::query();
  }

  public function map($book): array
  {
    $columns = [];

    if ($this->withTitle == true)
      array_push($columns, $book->title);
    if ($this->withAuthor == true)
      array_push($columns, $book->author);

    return $columns;
  }

  public function headings(): array
  {
    $headers = [];

    if ($this->withHeaders == true)
    {
      if ($this->withTitle == true)
      array_push($headers, 'Title');
      if ($this->withAuthor == true)
      array_push($headers, 'Author');
    }

    return [$headers];
  }

  public function withTitle(bool $flag)
  {
    $this->withTitle = $flag;
    return $this;
  }

  public function withAuthor(bool $flag)
  {
    $this->withAuthor = $flag;
    return $this;
  }

  public function withHeaders(bool $flag)
  {
    $this->withHeaders = $flag;
    return $this;
  }
}
