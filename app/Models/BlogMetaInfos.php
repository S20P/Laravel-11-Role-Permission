<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogMetaInfos extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'meta_key', 'meta_value','sort','status'];


    public function blog()
    {
        return $this->belongsTo(Blogs::class);
    }
}
