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
        Admin::create(['name' => 'Administrator', 'username' => 'admin', 'password' => Hash::make('123456')]);
    }
}
