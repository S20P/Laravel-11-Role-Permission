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
              'status'

    ];
}
