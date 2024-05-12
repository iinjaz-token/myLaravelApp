<?php

namespace App\CRUD;

use EasyPanel\Contracts\CRUDComponent;
use EasyPanel\Parsers\Fields\Field;
use App\Models\brand;

class brandComponent implements CRUDComponent
{
    // Manage actions in crud
    public $create = true;
    public $delete = true;
    public $update = true;

    // If you will set it true it will automatically
    // add `user_id` to create and update action
    public $with_user_id = true;

    public function getModel()
    {
        return brand::class;
    }

    // which kind of data should be showed in list page
    public function fields()
    {
        return ['file_path', 'name'];
    }

    // Searchable fields, if you dont want search feature, remove it
    public function searchable()
    {
        return ['file_path', 'name'];
    }

    // Write every fields in your db which you want to have a input
    // Available types : "ckeditor", "checkbox", "text", "select", "file", "textarea"
    // "password", "number", "email", "select", "date", "datetime", "time"
    public function inputs()
    {
        return [
            'name' => 'text',
            'file_path' => 'file'

        ];
    }

    // Validation in update and create actions
    // It uses Laravel validation system
    public function validationRules()
    {
        return [
            'name' => 'required|string|max:255', // Validate the brand name as a required string with a max length
            'file_path' => 'required|image|max:2048'  // Validate it's an image and limit the size to 2MB
        ];
    }

    // Where files will store for inputs
    public function storePaths()
    {
        return [
            'file_path' => 'uploads/brands',  // Store the files in 'storage/app/public/uploads/brands'
        ];
    }

    // Example method to handle file upload in update or create
    public function updateBrand($request)
    {
        $validatedData = $request->validate($this->validationRules());

        $brand = Brand::firstOrNew(['id' => $request->id]); // Assuming there's an 'id' in the request to differentiate between create and update

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = $file->hashName();
            $path = $file->storeAs($this->storePaths()['file_path'], $filename, 'public');
            $brand->file_path = $path;
        }

        $brand->name = $request->name;
        $brand->save();

        return back()->with('success', 'Brand updated successfully!');
    }
}
