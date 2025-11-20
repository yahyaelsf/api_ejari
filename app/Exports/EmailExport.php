<?php

namespace App\Exports;

use App\Models\TEmail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmailExport implements FromCollection,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TEmail::get();
    }

    public function map($email): array
    {
        return [
            $email->s_email,
        ];
    }

}
