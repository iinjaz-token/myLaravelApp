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
        return asset('images/default-logo.png');  // Assuming you have a default logo
    }

    // Ensure the path starts with a slash if not already present
    $path = $this->file_path[0] === '/' ? $this->file_path : '/' . $this->file_path;
    return asset('storage/uploads/logo' . $path);
}
}
