<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Setting::create(['key' => 'logo', 'value' => 'letter/logo.png']);
    	Setting::create(['key' => 'districts', 'value' => 'GIANYAR']);
    	Setting::create(['key' => 'sub-districts', 'value' => 'PAYANGAN']);
    	Setting::create(['key' => 'village', 'value' => 'BRESELA']);
    	Setting::create(['key' => 'village_head', 'value' => 'I Wayan']);
    	Setting::create(['key' => 'secretary','value' => 'II Wayan']);
    	Setting::create(['key' => 'vh_status', 'value' => 'on']);
    }
}
