<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;
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
    return view('book');
  }

  public function exportToExcel(Request $request)
  {
    return (new BookExport)->withTitle(boolval($request->input('withTitle')))
                           ->withAuthor(boolval($request->input('withAuthor')))
                           ->withHeaders(boolval($request->input('withHeaders')))
                           ->download('books.xlsx', Excel::XLSX);
  }

  public function exportToCSV(Request $request)
  {
    return (new BookExport)->withTitle(boolval($request->input('withTitle')))
                           ->withAuthor(boolval($request->input('withAuthor')))
                           ->withHeaders(boolval($request->input('withHeaders')))
                           ->download('books.csv', Excel::CSV);
  }
}
