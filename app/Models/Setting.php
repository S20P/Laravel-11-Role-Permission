<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = ['key','value','sort','status'];

    public function blogs()
    {
        return $this->belongsToMany(Blogs::class);
    }
    
}
