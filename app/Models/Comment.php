<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";

    protected $fillable = ['blog_id','user_id','parent_id','name','email','comment','status'];

    public function blog()
    {
        return $this->belongsTo(Blogs::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->where('status', 1);
    }

     //Accessor
     protected function status(): Attribute
     {
         return Attribute::make(
             get: fn (string $value) => ($value ? "Active" : "Inactive"),
         );
     }

}
