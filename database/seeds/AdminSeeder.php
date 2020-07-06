<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $init = New Admin;
        $init->name = "Agus Wahyu";
        $init->username = "agus";
        $init->password = Hash::make('123456');
        $init->save();
    }
}
