<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Setting::create(['key' => 'leftlogo', 'value' => 'assets/images/letter/left.png']);
        Setting::create(['key' => 'rightlogo', 'value' => 'assets/images/letter/right.png']);
    	Setting::create(['key' => 'districts', 'value' => 'GIANYAR']);
    	Setting::create(['key' => 'sub-districts', 'value' => 'PAYANGAN']);
    	Setting::create(['key' => 'village', 'value' => 'BRESELA']);
        Setting::create(['key' => 'address', 'value' => 'Jalan Amertha']);
        Setting::create(['key' => 'postal_code', 'value' => '81154']);
        Setting::create(['key' => 'website', 'value' => 'http://Busungbiu-buleleng.desa.id']);
        Setting::create(['key' => 'signatory_active', 'value' => '1']);
        Setting::create(['key' => 'whatsapp', 'value' => '6285777727179']);
    }
}
