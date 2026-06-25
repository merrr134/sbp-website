<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact.index', [
            'address' => SiteSetting::get('contact_address'),
            'phone'   => SiteSetting::get('contact_phone'),
            'email'   => SiteSetting::get('contact_email'),
            'hours'   => SiteSetting::get('contact_hours'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'message' => 'required|string|min:10',
        ]);

        Message::create($validated);

        return redirect()
            ->route('contact.index')
            ->with('success', 'Pesan Anda berhasil terkirim! Kami akan segera menghubungi Anda.');
    }
}
