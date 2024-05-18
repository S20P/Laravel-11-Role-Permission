<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Blogs extends Model
{
    use HasFactory;

    protected $table = "blogs";

    protected $fillable = [        
        'title',
        'slug',
        'short_description',
        'body',
        'image',
        'published_at',
        'sort',
        'status',
        'author_name',
        'user_id'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function metaInfos()
    {
        return $this->hasMany(BlogMetaInfos::class,'blog_id');
    }

    //Accessor
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ($value ? "Publish" : "Draft"),
        );
    }


    

}
