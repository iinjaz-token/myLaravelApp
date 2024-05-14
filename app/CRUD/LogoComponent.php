<?php

namespace App\CRUD;

use EasyPanel\Contracts\CRUDComponent;
use EasyPanel\Parsers\Fields\Field;
use Illuminate\Http\Request;
use App\Models\Logo;

class LogoComponent implements CRUDComponent
{
    public $create = true;
    public $delete = true;
    public $update = true;
    public $with_user_id = false;

    public function getModel()
    {
        return Logo::class;
    }

    public function fields()
    {
        return ['file_path'];
    }

    public function searchable()
    {
        return ['file_path'];
    }

    public function inputs()
    {
        return [
            'file_path' => 'file' // Set the type to 'file'
        ];
    }

    public function validationRules()
    {
        return [
            'file_path' => 'required|image|max:2048',  // Validate it's an image and limit the size
        ];
    }

    public function storePaths()
{
    return [
        'file_path' => 'uploads/logo',
    ];
}


public function updateLogo(Request $request)
{
    $request->validate([
        'file_path' => 'required|image|max:2048',
    ]);

    $file = $request->file('file_path');
    $filename = $file->hashName();

    // Ensure the file is stored in 'uploads/logo'
    $path = $file->storeAs('uploads/logo', $filename, 'public');

    // Save or update the logo path in the database
    $logo = Logo::firstOrNew();  // Assuming there's only one logo record
    $logo->file_path = $path;  // Save the path as 'uploads/logo/filename.png'
    $logo->save();

    return back()->with('success', 'Logo updated successfully!');
}

}