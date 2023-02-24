<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Supports\Utilitis\DateTimeFormater;
use Carbon\Carbon;
use App\Models\{Tag, File, Category, User};

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

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function getBodyAttribute($value)
    // {
    //     return Str::limit($value, 100);
    // }

    public function getUpdatedAtAttribute($value)
    {
        // return Carbon::create($value)->format('Y-m-d');
        return $this->getFormatedDate($value, 'd-m-Y');
    }

    public function getCreatedAtAttribute($value)
    {
        // return Carbon::create($value)->format('Y-m-d');
        return $this->getFormatedDate($value, 'F d, Y');
    }
}
