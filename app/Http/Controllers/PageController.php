<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showHeader()
    {
        $header = Header::latest()->first(); // Ensure you fetch the latest header entry
        return view('index', ['headerText' => $header ? $header->name : 'Default Header']);
    }
}
