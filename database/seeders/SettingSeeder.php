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
            ],
            [
                "key" => "social_media_enabled", "value" => "active"
            ],
            [
                "key" => "site_title", "value" => "horoscope 7 day"
            ],
            [
                "key" => "site_description", "value" => "horoscope 7 day"
            ],
            [
                "key" => "tagline", "value" => "horoscope 7 day"
            ],
            [
                "key" => "site_icon	", "value" => ""
            ],  
            [
                "key" => "blog_pagination", "value" => "10"
            ]                     
         ];

         foreach ($settings as $setting) {
            Setting::create(['key' => $setting['key'],'value' => $setting['value'] ]);
          }
    }
}
