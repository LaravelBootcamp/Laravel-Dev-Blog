<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'orginal_name',
        'storage_path',
        'view_path',
        'file_size',
        'file_type',
        'user_id'
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}
