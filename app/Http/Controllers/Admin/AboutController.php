<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function edit()
    {
        $sections = AboutPage::all()->keyBy('section');
        return view('admin.about.edit', compact('sections'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'sections.*.title'   => 'required|string|max:255',
            'sections.*.content' => 'nullable|string',
            'sections.*.image'   => 'nullable|image|max:2048',
            'stat_founded'       => 'nullable|string|max:20',
            'stat_employees'     => 'nullable|string|max:20',
            'stat_locations'     => 'nullable|string|max:20',
            'company_vision'     => 'nullable|string',
            'company_mission_1'  => 'nullable|string',
            'company_mission_2'  => 'nullable|string',
            'company_mission_3'  => 'nullable|string',
            'timeline_1_year'    => 'nullable|string|max:20',
            'timeline_1_title'   => 'nullable|string|max:255',
            'timeline_1_desc'    => 'nullable|string',
            'timeline_2_year'    => 'nullable|string|max:20',
            'timeline_2_title'   => 'nullable|string|max:255',
            'timeline_2_desc'    => 'nullable|string',
            'timeline_3_year'    => 'nullable|string|max:20',
            'timeline_3_title'   => 'nullable|string|max:255',
            'timeline_3_desc'    => 'nullable|string',
            'timeline_4_year'    => 'nullable|string|max:20',
            'timeline_4_title'   => 'nullable|string|max:255',
            'timeline_4_desc'    => 'nullable|string',
        ]);

        // Update about pages
        foreach ($request->sections as $section => $data) {
            $aboutPage = AboutPage::where('section', $section)->first();
            if (!$aboutPage) continue;

            $updateData = [
                'title'   => $data['title'],
                'content' => $data['content'] ?? $aboutPage->content,
            ];

            if (isset($data['image']) && $data['image']->isValid()) {
                if ($aboutPage->image) {
                    Storage::disk('public')->delete($aboutPage->image);
                }
                $updateData['image'] = $data['image']->store('about', 'public');
            }

            $aboutPage->update($updateData);
        }

        // Simpan stats
        if ($request->stat_founded)   SiteSetting::set('stat_founded',   $request->stat_founded);
        if ($request->stat_employees) SiteSetting::set('stat_employees', $request->stat_employees);
        if ($request->stat_locations) SiteSetting::set('stat_locations', $request->stat_locations);

        // Simpan visi misi
        if ($request->company_vision)    SiteSetting::set('company_vision',    $request->company_vision);
        if ($request->company_mission_1) SiteSetting::set('company_mission_1', $request->company_mission_1);
        if ($request->company_mission_2) SiteSetting::set('company_mission_2', $request->company_mission_2);
        if ($request->company_mission_3) SiteSetting::set('company_mission_3', $request->company_mission_3);

        // Simpan timeline
        foreach ([1,2,3,4] as $n) {
            if ($request->input("timeline_{$n}_year"))  SiteSetting::set("timeline_{$n}_year",  $request->input("timeline_{$n}_year"));
            if ($request->input("timeline_{$n}_title")) SiteSetting::set("timeline_{$n}_title", $request->input("timeline_{$n}_title"));
            if ($request->input("timeline_{$n}_desc"))  SiteSetting::set("timeline_{$n}_desc",  $request->input("timeline_{$n}_desc"));
        }

        return redirect()
            ->route('admin.about.edit')
            ->with('success', 'Konten Tentang Kami berhasil diperbarui!');
    }
}
