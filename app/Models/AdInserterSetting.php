<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdInserterSetting extends Model
{
    use HasFactory;

    protected $table = "ad_inserter_settings";

    protected $fillable = [
              'key',
              'value',
              'page_type',
              'position',
              'alignment',
              'css',
              'status'
    ];   

    
    public static function ad_inserter_inject($pageType,$position)
    {
        return self::select('key','value','page_type','position','alignment')
        ->where('status',1)
        ->where('page_type', 'LIKE', '%' . $pageType . '%')
        ->where("position",$position)->get();
    }


}
