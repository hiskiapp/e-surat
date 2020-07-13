<?php

use Illuminate\Database\Seeder;
use App\Signatory;

class SignatorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Signatory::create(['name' => 'Joko Widodo', 'position' => 'Kepala Desa']);
    }
}
