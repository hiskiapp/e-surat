<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersImport implements ToModel, WithHeadingRow, SkipsOnError, WithCalculatedFormulas
{
	use Importable, SkipsErrors;
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
    	dd($row);
    }
}