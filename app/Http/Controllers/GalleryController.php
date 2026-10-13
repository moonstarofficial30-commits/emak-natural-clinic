<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::latest()->get()->groupBy('category');

        return view('gallery', compact('images'));
    }
}
