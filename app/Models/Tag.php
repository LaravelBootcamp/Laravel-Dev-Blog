<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Supports\Utilitis\DateTimeFormater;
use App\Supports\Database\DataInsertHelper;
use App\Models\Post;


class Tag extends Model
{
    use HasFactory, SoftDeletes, DateTimeFormater, DataInsertHelper;
    protected $fillable = [
        'name', 'description', 'status'
    ];


    //Relations
    public function post()
    {
        return $this->belongsToMany(Post::class);
    }

    //Date formate mutator
    public function getUpdatedAtAttribute($value)
    {
        return $this->getFormatedDate(date: $value, formate: 'd-M-Y');
    }

    // White space remove accessor
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = trim($value);
    }

    //Slug Genaratror
    public function setNameAttribute($value)
    {
        $this->attributes['name']  = $value;
        $this->attributes['slug']  = $this->uinqueSlug($value, Tag::class);   
    }

}
