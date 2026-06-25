<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Photo;
use App\Models\Message;
use App\Models\Partner;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalNews'      => News::count(),
            'totalPhotos'    => Photo::count(),
            'totalPartners'  => Partner::count(),
            'unreadMessages' => Message::where('is_read', false)->count(),
            'recentMessages' => Message::latest()->take(5)->get(),
            'recentNews'     => News::latest()->take(5)->get(),
        ]);
    }
}
