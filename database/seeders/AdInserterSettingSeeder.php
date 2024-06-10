<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdInserterSetting;
class AdInserterSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $block = 100;
        for($i=1; $i<=$block; $i++){
                AdInserterSetting::create([
                    'key' => 'block'.$i,
                    'value' => "",
                    'page_type' => "",
                    'position' => "before_post",
                    'alignment' => "left",
                    'css' => "",
                    'status'=> true
                ]);
          }
    }
}
