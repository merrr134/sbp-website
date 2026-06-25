<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSettingController extends Controller
{
    public function edit()
    {
        $slides = [];
        for ($i = 1; $i <= 4; $i++) {
            $slides[$i] = [
                'img'      => SiteSetting::get("hero_slide_{$i}_img"),
                'title'    => SiteSetting::get("hero_slide_{$i}_title"),
                'subtitle' => SiteSetting::get("hero_slide_{$i}_subtitle"),
            ];
        }

        return view('admin.home.edit', [
            'slides'   => $slides,
            'settings' => [
                'hero_cta_primary'   => SiteSetting::get('hero_cta_primary'),
                'hero_cta_secondary' => SiteSetting::get('hero_cta_secondary'),
                'about_home_title'   => SiteSetting::get('about_home_title'),
                'about_home_content' => SiteSetting::get('about_home_content'),
                'contact_address'    => SiteSetting::get('contact_address'),
                'contact_phone'      => SiteSetting::get('contact_phone'),
                'contact_email'      => SiteSetting::get('contact_email'),
                'contact_hours'      => SiteSetting::get('contact_hours'),
            ]
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_cta_primary'      => 'required|string|max:100',
            'hero_cta_secondary'    => 'required|string|max:100',
            'about_home_title'      => 'required|string|max:255',
            'about_home_content'    => 'required|string',
            'contact_address'       => 'required|string',
            'contact_phone'         => 'required|string|max:50',
            'contact_email'         => 'required|email|max:100',
            'contact_hours'         => 'required|string|max:100',
            'slides.*.title'        => 'required|string|max:255',
            'slides.*.subtitle'     => 'required|string',
            'slides.*.img'          => 'nullable|image|max:2048',
        ]);

        // Simpan CTA & About
        SiteSetting::set('hero_cta_primary',   $request->hero_cta_primary);
        SiteSetting::set('hero_cta_secondary',  $request->hero_cta_secondary);
        SiteSetting::set('about_home_title',    $request->about_home_title);
        SiteSetting::set('about_home_content',  $request->about_home_content);
        SiteSetting::set('contact_address',     $request->contact_address);
        SiteSetting::set('contact_phone',       $request->contact_phone);
        SiteSetting::set('contact_email',       $request->contact_email);
        SiteSetting::set('contact_hours',       $request->contact_hours);

        // Simpan slides
        foreach ($request->slides as $i => $slide) {
            SiteSetting::set("hero_slide_{$i}_title",    $slide['title']);
            SiteSetting::set("hero_slide_{$i}_subtitle", $slide['subtitle']);

            if (isset($slide['img']) && $slide['img']->isValid()) {
                $old = SiteSetting::get("hero_slide_{$i}_img");
                if ($old) Storage::disk('public')->delete($old);
                SiteSetting::set("hero_slide_{$i}_img", $slide['img']->store('hero', 'public'));
            }
        }

        return redirect()
            ->route('admin.home.edit')
            ->with('success', 'Pengaturan Home berhasil disimpan!');
    }
}
