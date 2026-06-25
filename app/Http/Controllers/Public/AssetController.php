<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Asset;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::orderBy('order')->get();
        return view('public.about.assets', compact('assets'));
    }

    public function show(string $slug)
    {
        $asset  = Asset::where('slug', $slug)->with('photos')->firstOrFail();
        $assets = Asset::orderBy('order')->get();
        return view('public.about.asset-detail', compact('asset', 'assets'));
    }
}
