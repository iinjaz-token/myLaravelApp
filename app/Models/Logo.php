<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = ['file_path']; // Ensure this is fillable

    public function getLogoUrlAttribute()
    {
        return asset('storage/uploads/logo/' . $this->file_path);
    }
}
