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
    if (!$this->file_path) {
        return asset('images/default-logo.png'); // Fallback to a default logo
    }
    return asset('storage/' . $this->file_path);
}


}
