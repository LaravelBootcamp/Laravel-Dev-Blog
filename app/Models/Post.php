<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{Tag, File};
use Illuminate\Support\Str;
use App\Supports\Utilitis\DateTimeFormater;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory, SoftDeletes, DateTimeFormater;



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

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d');
        //return $this->getFormatedDate($value, 'd-M-Y');
    }
}
