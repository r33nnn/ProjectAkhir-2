<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $Galeris = Galeri::latest()->get();
        return view('admin.galeris.index', compact('Galeris'));
    }

    public function create()
    {
        return view('admin.galeris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'nullable|date'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galeri', 'public');
            \Log::info('Image uploaded: ' . $data['image']);
        }

        Galeri::create($data);

        return redirect()->route('galeris.index')
            ->with('success', 'Galeri berhasil ditambahkan');
    }

    public function show(Galeri $Galeri)
    {
        return view('admin.galeris.show', compact('Galeri'));
    }

    public function edit(Galeri $Galeri)
    {
        return view('admin.galeris.edit', compact('Galeri'));
    }

    public function update(Request $request, Galeri $Galeri)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'nullable|date'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus file lama (opsional tapi direkomendasikan)
            if ($Galeri->image && \Storage::disk('public')->exists($Galeri->image)) {
                \Storage::disk('public')->delete($Galeri->image);
            }
            $data['image'] = $request->file('image')->store('galeri', 'public');
        }

        $Galeri->update($data);

        return redirect()->route('galeris.index')
            ->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy(Galeri $Galeri)
    {
        $Galeri->delete();

        return redirect()->route('galeris.index')
            ->with('success', 'Galeri berhasil dihapus');
    }
}