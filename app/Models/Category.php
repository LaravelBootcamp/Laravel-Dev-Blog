<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Supports\Utilitis\DateTimeFormater;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Supports\Database\DataInsertHelper;
use App\Models\File;

class Category extends Model
{
    use HasFactory, DateTimeFormater, SoftDeletes, DataInsertHelper;

    protected $fillable = [
        'name', 'slug', 'description', 'status'
    ];

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->getFormatedDate(date: $value);
    }

    //Slug Genaratror
    public function setNameAttribute($value)
    {
        $this->attributes['name']  = $value;
        $this->attributes['slug']  = $this->uinqueSlug($value, Category::class);   
    }

    
}
