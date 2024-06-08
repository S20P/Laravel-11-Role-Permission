<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SocialMediaSetting as SMsetting;

class SocialMediaSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'name' => "Facebook",
                'slug' => 'facebook',
                'url' => "#",
                'icon' => "bi bi-facebook",
                'sort_order' => 1,
                'status' => 1
            ],
            [
                'name' => "Twitter",
                'slug' => 'twitter',
                'url' => "#",
                'icon' => "bi bi-twitter",
                'sort_order' => 2,
                'status' => 1
            ],
            [
                'name' => "Instagram",
                'slug' => 'instagram',
                'url' => "#",
                'icon' => "bi bi-instagram",
                'sort_order' => 3,
                'status' => 1
            ],
            [
                'name' => "Linkedin",
                'slug' => 'linkedin',
                'url' => "#",
                'icon' => "bi bi-linkedin",
                'sort_order' => 4,
                'status' => 1
            ],
            [
                'name' => "Youtube",
                'slug' => 'youtube',
                'url' => "#",
                'icon' => "bi bi-youtube",
                'sort_order' => 5,
                'status' => 1
            ],
            [
                'name' => "Whatsapp",
                'slug' => 'whatsapp',
                'url' => "#",
                'icon' => "bi bi-whatsapp",
                'sort_order' => 6,
                'status' => 1
            ]                              
         ];

         SMsetting::insert($settings);
    }
}
