<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use App\Supports\Utilitis\DateTimeFormater;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, DateTimeFormater, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'status'
    ];

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->getFormatedData(date: $value);
    }
}
