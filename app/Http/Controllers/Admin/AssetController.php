<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::withCount('photos')->orderBy('order')->get();
        return view('admin.assets.index', compact('assets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail'   => 'required|image|max:2048',
        ]);

        Asset::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'thumbnail'   => $request->file('thumbnail')->store('assets', 'public'),
            'order'       => Asset::count(),
        ]);

        return redirect()->route('admin.assets.index')
                         ->with('success', 'Aset berhasil ditambahkan!');
    }

    public function show(Asset $asset)
    {
        $asset->load('photos');
        return view('admin.assets.show', compact('asset'));
    }

    public function uploadPhotos(Request $request, Asset $asset)
    {
        $request->validate([
            'photos'   => 'required|array',
            'photos.*' => 'image|max:2048',
        ]);

        foreach ($request->file('photos') as $file) {
            AssetPhoto::create([
                'asset_id'  => $asset->id,
                'file_path' => $file->store('assets/photos', 'public'),
            ]);
        }

        return redirect()->route('admin.assets.show', $asset->id)
                         ->with('success', 'Foto berhasil diupload!');
    }

    public function destroy(Asset $asset)
    {
        Storage::disk('public')->delete($asset->thumbnail);
        foreach ($asset->photos as $photo) {
            Storage::disk('public')->delete($photo->file_path);
        }
        $asset->delete();

        return redirect()->route('admin.assets.index')
                         ->with('success', 'Aset berhasil dihapus!');
    }

    public function destroyPhoto(AssetPhoto $photo)
    {
        Storage::disk('public')->delete($photo->file_path);
        $assetId = $photo->asset_id;
        $photo->delete();

        return redirect()->route('admin.assets.show', $assetId)
                         ->with('success', 'Foto berhasil dihapus!');
    }
}
