<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->paginate(12);
        return view('admin.gallery.index', compact('photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photos'   => 'required|array|min:1',
            'photos.*' => 'image|max:2048',
        ]);

        foreach ($request->file('photos') as $file) {
            Photo::create([
                'file_path' => $file->store('gallery', 'public'),
            ]);
        }

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Foto berhasil diupload!');
    }

    public function destroy(Photo $photo)
    {
        Storage::disk('public')->delete($photo->file_path);
        $photo->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Foto berhasil dihapus!');
    }
}
