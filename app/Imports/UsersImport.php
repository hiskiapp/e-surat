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
use Carbon\Carbon;

class UsersImport implements ToModel, WithHeadingRow, WithCalculatedFormulas, SkipsOnError
{
    use Importable, SkipsErrors;
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        $birthDate = Carbon::parse(Date::excelToDateTimeObject($row['tanggal_lahir']));

        return new User([
            'sin' => $row['nik'],
            'name'     => ucwords($row['nama']),
            'password' => Hash::make($birthDate->format('d-m-Y')),
            'birth_place' => $row['tempat_lahir'],
            'birth_date' => $birthDate->format('Y-m-d'),
            'gender' => $row['jenis_kelamin'],
            'address' => $row['alamat'],
            'religion' => $row['agama'],
            'marital_status' => $row['status_perkawinan'],
            'profession' => $row['pekerjaan']
        ]);
    }
}
