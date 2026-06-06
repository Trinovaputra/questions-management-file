<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Materi::query();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $materi = $query->latest()->get();

        return view('admin.materi.index', compact('materi'));
    }

    public function siswaIndex(Request $request)
    {
        $query = Materi::query();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $materis = $query->latest()->paginate(12);

        return view('siswa.materi.index', compact('materis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'required|in:pdf,image,youtube',
            'youtube_url' => 'required_if:type,youtube|nullable|url',
            'file' => [
                'required_if:type,pdf,image',
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png'
            ]
        ]);

        $path = null;

        if ($request->hasFile('file')) {
            $path = $request->file('file')
                ->store('materi', 'public');
        }

        $materi = Materi::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'file_path' => $path,
            'youtube_url' => $request->youtube_url,
            'created_by' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Materi berhasil ditambahkan',
            'data' => $materi
        ], 201);
    }

    public function detail($id)
    {
        $materi = Materi::findOrFail($id);

        return response()->json([
            'id' => $materi->id,
            'title' => $materi->title,
            'description' => $materi->description,
            'type' => $materi->type
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $materi = Materi::with('creator')
        ->findOrFail($id);

        return view('admin.materi.detail', compact('materi'));
    }

    public function showSiswa($id)
    {
        $materi = Materi::findOrFail($id);

        return view('siswa.materi.detail', compact('materi'));
    }

    public function download($id)
    {
        $materi = Materi::findOrFail($id);

        if (!$materi->file_path) {
            return response()->json([
                'message' => 'File tidak tersedia'
            ], 404);
        }

        return Storage::disk('public')
            ->download($materi->file_path);
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        return view('admin.materi.edit', compact('materi'));
    }

    public function update(Request $request, string $id)
    {
        $materi = Materi::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'required|in:pdf,image,youtube',
            'youtube_url' => 'required_if:type,youtube|nullable|url',
            'file' => [
                'required_if:type,pdf,image',
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png'
            ]
        ]);

        // memperbarui file
        if ($request->hasFile('file')) {
            if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
                Storage::disk('public')->delete($materi->file_path);
            }
            $materi->file_path = $request->file('file')->store('materi', 'public');
        }
        $materi->title = $request->title;
        $materi->description = $request->description;
        $materi->type = $request->type;
        $materi->youtube_url = $request->youtube_url;

        $materi->save();

        return redirect()->route('materi.admin.index')
        ->with('success', 'Materi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $materi = Materi::findOrFail($id);

        $materi->delete();

        return view('admin.materi.index')->with('success', 'Materi berhasil dihapus');
    }
}
