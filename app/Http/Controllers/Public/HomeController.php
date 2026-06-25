<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\News;
use App\Models\Photo;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $defaultImgs = [
            1 => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=1920&q=80',
            2 => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1920&q=80',
            3 => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=1920&q=80',
            4 => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=1920&q=80',
        ];

        $slides = [];
        for ($i = 1; $i <= 4; $i++) {
            $savedImg = SiteSetting::get("hero_slide_{$i}_img");
            $slides[] = [
                'img'      => $savedImg ? Storage::url($savedImg) : $defaultImgs[$i],
                'title'    => SiteSetting::get("hero_slide_{$i}_title"),
                'subtitle' => SiteSetting::get("hero_slide_{$i}_subtitle"),
            ];
        }

        return view('public.home', [
            'slides'  => $slides,
            'settings' => [
                'hero_title'         => SiteSetting::get('hero_title'),
                'hero_subtitle'      => SiteSetting::get('hero_subtitle'),
                'hero_cta_primary'   => SiteSetting::get('hero_cta_primary'),
                'hero_cta_secondary' => SiteSetting::get('hero_cta_secondary'),
                'about_home_title'   => SiteSetting::get('about_home_title'),
                'about_home_content' => SiteSetting::get('about_home_content'),
            ],
            'latestNews' => News::published()->take(3)->get(),
            'photos'     => Photo::latest()->take(6)->get(),
            'partners'   => Partner::latest()->get(),
        ]);
    }
}
