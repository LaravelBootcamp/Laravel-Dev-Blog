<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{Tag, File};
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;



    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }


    public function getBodyAttribute($value)
    {
        return Str::limit($value, 100);
    }
}
