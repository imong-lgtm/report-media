<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $profile = CompanyProfile::first() ?? new CompanyProfile();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'profile' => 'nullable|string',
            'ethics' => 'nullable|string',
            'guidelines' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'logo_upload' => 'nullable|image|max:2048'
        ]);

        $profile = CompanyProfile::first() ?? new CompanyProfile();

        $data = $request->except('logo_upload');

        if ($request->hasFile('logo_upload')) {
            $file = $request->file('logo_upload');
            $data['logo'] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->path()));
        }

        if ($profile->exists) {
            $profile->update($data);
        } else {
            CompanyProfile::create($data);
        }

        return redirect()->route('admin.profile.edit')->with('success', 'Profil perusahaan berhasil diperbarui!');
    }
}
