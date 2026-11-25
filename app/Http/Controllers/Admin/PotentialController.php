<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Potential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PotentialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $potentials = Potential::orderBy('id', 'desc')->paginate(10);

        return view('admin.potential.index', compact('potentials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.potential.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'map_url' => 'nullable|url', 
            
        ]);

        $imagePath = $this->handleImageUpload($request);

        Potential::create([
            'title'   => $request->title,
            'content' => $request->content,
            'image'   => $imagePath,
            'map_url' => $request->map_url,
            
        ]);

        return redirect()->route('admin.potential.index')
            ->with('success', 'Potensi desa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Potential $potential)
{
    return view('admin.potential.show', compact('potential'));
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Potential $potential)
    {
        return view('admin.potential.edit', compact('potential'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Potential $potential)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'map_url' => 'nullable|url',
        ]);

        $data = [
            'title'   => $request->title,
            'content' => $request->content,
            'map_url' => $request->map_url,
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if (!empty($potential->image) && Storage::disk('public')->exists($potential->image)) {
                Storage::disk('public')->delete($potential->image);
            }

            // Upload gambar baru
            $data['image'] = $this->handleImageUpload($request);
        }

        $potential->update($data);

        return redirect()->route('admin.potential.index')
            ->with('success', 'Potensi desa berhasil diperbarui.');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Potential $potential)
    {
        if ($potential->image && Storage::disk('public')->exists($potential->image)) {
            Storage::disk('public')->delete($potential->image);
        }

        $potential->delete();

        return redirect()->route('admin.potential.index')
            ->with('danger', 'Potensi desa berhasil dihapus.');
    }

    



    /**
     * Handle image upload (used by store & update).
     */
    private function handleImageUpload(Request $request): ?string
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');

            // Bersihkan nama file dan tambahkan timestamp
            $imageName = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '', $image->getClientOriginalName());

            // Folder tujuan
            $destinationPath = storage_path('app/public/potentials');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Pindahkan file ke folder
            $image->move($destinationPath, $imageName);

            // Return path relatif untuk database
            return 'potentials/' . $imageName;
        }

        return null;
    }
}
