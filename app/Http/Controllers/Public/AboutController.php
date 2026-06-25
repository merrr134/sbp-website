<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\SiteSetting;

class AboutController extends Controller
{
    public function company()
    {
        $about = AboutPage::where('section', 'company')->firstOrFail();
        $stats = [
            ['value' => SiteSetting::get('stat_founded',   '1988'), 'label' => 'Tahun Berdiri'],
            ['value' => SiteSetting::get('stat_employees', '5K+'),  'label' => 'Karyawan'],
            ['value' => SiteSetting::get('stat_locations', '14'),   'label' => 'Lokasi Tambang'],
        ];
        return view('public.about.company', compact('about', 'stats'));
    }

    public function visionMission()
    {
        $about = AboutPage::where('section', 'vision_mission')->firstOrFail();
        return view('public.about.vision-mission', compact('about'));
    }

    public function history()
    {
        $about = AboutPage::where('section', 'history')->firstOrFail();
        return view('public.about.history', compact('about'));
    }

    public function assets()
    {
        $about = AboutPage::where('section', 'assets')->firstOrFail();
        return view('public.about.assets', compact('about'));
    }
}
