<?php

namespace App\CRUD;

use EasyPanel\Contracts\CRUDComponent;
use EasyPanel\Parsers\Fields\Field;
use Illuminate\Http\Request;
use App\Models\Logo;

class LogoComponent implements CRUDComponent
{
    // Manage actions in crud
    public $create = true;
    public $delete = true;
    public $update = true;

    // If you will set it true it will automatically
    // add `user_id` to create and update action
    public $with_user_id = false;

    public function getModel()
    {
        return Logo::class;
    }

    // which kind of data should be showed in list page
    public function fields()
    {
        return ['file_path'];
    }

    // Searchable fields, if you dont want search feature, remove it
    public function searchable()
    {
        return ['file_path'];
    }

    // Write every fields in your db which you want to have a input
    // Available types : "ckeditor", "checkbox", "text", "select", "file", "textarea"
    // "password", "number", "email", "select", "date", "datetime", "time"
    public function inputs()
    {
        return [
            'file_path' => 'file' // Set the type to 'file'
        ];
    }

    // Validation in update and create actions
    // It uses Laravel validation system
    public function validationRules()
    {
        return [
            'file_path' => 'required|image|max:2048',  // Validate it's an image and limit the size
        ];
    }

    // Where files will store for inputs
    public function storePaths()
    {
        return [
            'file_path' => 'uploads/logo',  // Store the files storage\uploads\logo
        ];
    }

    // Custom update method for handling file upload
    public function updateLogo(Request $request)
{
    $request->validate([
        'file_path' => 'required|image|max:2048',
    ]);

    $file = $request->file('file_path');
    $filename = $file->hashName();

    // Ensure the file is stored in 'storage/uploads/logo'
    $path = $file->storeAs('uploads/logo', $filename, 'storage');

    // Save or update the logo path in the database
    $logo = Logo::firstOrNew();  // Assuming there's only one logo record
    $logo->file_path = $path;  // Save the path as 'uploads/logo/filename.png'
    $logo->save();

    return back()->with('success', 'Logo updated successfully!');
}

}
