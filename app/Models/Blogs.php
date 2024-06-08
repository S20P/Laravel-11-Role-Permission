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
        'user_id',
        'views'
    ];


    //Accessor
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ($value ? "Publish" : "Draft"),
        );
    }

    // Many-to-Many Relationship
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    //One-to-Many Relationship
    public function metaInfos()
    {
        return $this->hasMany(BlogMetaInfos::class,'blog_id');
    }

    //Many-to-Many Relationship
    public function settings()
    {
        return $this->belongsToMany(Setting::class,'blogs_setting');
    }

     //One-to-Many Relationship
    public function comments()
    {
        return $this->hasMany(Comment::class,'blog_id')->whereNull('parent_id')->where('status', 1);
    }

    //Has-One-Of-Many Relationship :: latest 
    public function latestComment() {
        return $this->hasOne(Comment::class,'blog_id')->latestOfMany();
    }

     //Has-One-Of-Many Relationship :: oldest 
    public function oldestComment() {
        return $this->hasOne(Comment::class,'blog_id')->oldestOfMany();
    }
   

}
