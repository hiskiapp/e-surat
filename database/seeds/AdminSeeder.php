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
        $init = new Admin;
        $init->name = "Administrator";
        $init->username = "admin";
        $init->password = Hash::make('123456');
        $init->save();
    }
}
