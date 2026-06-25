<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::latest()->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'logo_path' => 'required|image|max:2048',
        ]);

        Partner::create([
            'name'      => $request->name,
            'logo_path' => $request->file('logo_path')->store('partners', 'public'),
        ]);

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Mitra berhasil ditambahkan!');
    }

    public function destroy(Partner $partner)
    {
        Storage::disk('public')->delete($partner->logo_path);
        $partner->delete();

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Mitra berhasil dihapus!');
    }
}
