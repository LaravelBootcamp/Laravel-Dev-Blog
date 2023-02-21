<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class GenaralSetting extends Model
{
    use HasFactory;

    protected $fillable= ['key', 'value'];

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
