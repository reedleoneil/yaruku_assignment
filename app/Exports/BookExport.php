<?php

namespace App\Exports;

 use App\Models\Book;
// use Maatwebsite\Excel\Concerns\FromCollection;
//
// class BookExport implements FromCollection
// {
//     public function collection()
//     {
//         return Book::all();
//     }
// }

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Book::query();
    }

    public function map($book): array
    {
        return [
            $book->title,
            $book->author
        ];
    }

    public function headings(): array
    {
        return [
            'Title',
            'Author'
        ];
    }
}
