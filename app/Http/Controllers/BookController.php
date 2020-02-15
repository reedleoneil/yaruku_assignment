<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;

use App\Exports\BookExport;
use Maatwebsite\Excel\Excel;

class BookController extends Controller
{
    protected $bookRepository;
    private $excel;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        $books = $this->bookRepository->getBooks();
        return view('book', ['books' => $books]);
    }

    public function export(Excel $excel)
    {
        return $excel->download(new BookExport, 'books.xlsx');
    }
}
