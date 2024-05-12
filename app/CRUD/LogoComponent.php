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
            'file_path' => 'public/uploads/logo',  // Store the files in public/uploads/logo
        ];
    }

    // Custom update method for handling file upload
    public function updateLogo(Request $request)
    {
        $request->validate([
            'file_path' => 'required|image|max:2048', // Validation rules
        ]);

        // Retrieve the uploaded file
        $file = $request->file('file_path');
        
        // Generate a unique filename
        $filename = $file->hashName();

        // Store the file in the public/uploads/logo directory
        $path = $file->storeAs('public/uploads/logo', $filename);

        // Save or update the logo path in the database
        $logo = Logo::firstOrNew(); // Assuming there's only one logo record
        $logo->file_path = 'uploads/logo/' . $filename; // Store relative path
        $logo->save();

        // Redirect back with success message
        return back()->with('success', 'Logo updated successfully!');
    }
}
