<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSettings extends Model
{
    use HasFactory;

    protected $table = "blogs_setting";

    protected $fillable = ['blogs_id', 'setting_id'];
   
}
