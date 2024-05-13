<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\Brand;
use App\Models\TitelBrand; 
class PageController extends Controller
{
    public function showHeader()
    {
        $header = Header::latest()->first();
        $logo = Logo::latest()->first(); // Fetch the latest logo entry
        $brands = Brand::all();
        $titelBrand = TitelBrand::latest()->first(); // Ensure variable naming is consistent and correctly cased

        // Ensure attribute names are correctly cased as defined in your model
        $title = $titelBrand ? $titelBrand->title : "Default Title";
        $subTitle = $titelBrand ? $titelBrand->sub_title : "Default Subtitle";

        return view('index', [
            'headerText' => $header ? $header->name : 'Default Header',
            'logoUrl' => $logo ? $logo->getLogoUrlAttribute() : asset('path/to/default/logo.png'),
            'brands' => $brands,
            'title' => $title,
            'subTitle' => $subTitle
        ]);
    }
}
