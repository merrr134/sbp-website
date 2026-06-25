<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Photo;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->paginate(12);
        return view('public.gallery.index', compact('photos'));
    }
}
