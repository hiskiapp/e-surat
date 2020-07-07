<?php

namespace App\Imports;

use App\Admin;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class AdminsImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable, SkipsErrors;
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new Admin([
            'name'     => ucwords($row['nama']),
            'username' => strtolower($row['username']),
            'password' => Hash::make($row['password']),
        ]);
    }
}
