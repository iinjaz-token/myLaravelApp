<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\Brand;

class PageController extends Controller
{
    public function showHeader()
    {
        $header = Header::latest()->first();
        $logo = Logo::latest()->first(); // Fetch the latest logo entry
        $brands = Brand::all();

        return view('index', [
            'headerText' => $header ? $header->name : 'Default Header',
            'logoUrl' => $logo ? $logo->getLogoUrlAttribute() : asset('path/to/default/logo.png'), // Provide a default logo path if none is found
            'brands' => $brands
        ]);
    }
}
