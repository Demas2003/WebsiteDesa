<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'village_name' => 'required|string|max:255',
            'description' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'office_hours' => 'required|string',
        ]);

        $profile = Profile::first();
        if ($profile) {
            $profile->update($validatedData);
        } else {
            Profile::create($validatedData);
        }

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profil desa berhasil diperbarui.');
    }
}
