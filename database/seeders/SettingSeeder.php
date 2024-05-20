<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                "key" => "header", "value" => ""
            ],
            [
                "key" => "footer", "value" => ""
            ],
            [
                "key" => "block", "value" => ""
            ]                   
         ];

         foreach ($settings as $setting) {
            Setting::create(['key' => $setting['key'],'value' => $setting['value'] ]);
          }
    }
}
