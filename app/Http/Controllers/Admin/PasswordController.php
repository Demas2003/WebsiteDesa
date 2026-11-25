<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('admin.password.edit');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // User model memiliki cast "hashed", jadi password otomatis di-hash.
        $request->user()->update([
            'password' => $validated['password'],
        ]);

        return redirect()->route('admin.password.edit')
            ->with('success', 'Password berhasil diubah.');
    }
}
