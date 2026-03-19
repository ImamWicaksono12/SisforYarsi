<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beasiswa;
use App\Models\PersyaratanBeasiswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BeasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Beasiswa::query();

        if ($search = $request->input('search')) {
            $query->where('nama', 'like', "%{$search}%");
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $data = $query->with('persyaratan')->latest()->paginate(10);

        return view('beasiswa.index', compact('data'));
    }

    public function create()
    {
        return view('beasiswa.create');
    }

    public function edit($id)
    {
            $item = Beasiswa::with('persyaratan')->findOrFail($id);
                return view('beasiswa.edit', compact('item'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama'              => 'required',
            'sumber_beasiswa'   => 'required',
            'tipe_beasiswa'     => 'required|in:fully_funded,partial_funded,one_shot',
            'status'            => 'required|in:buka,tutup,aktif',
            'periode'           => 'required',
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'required|date|after:tanggal_mulai',
            'kuota'             => 'nullable|integer',
            'deskripsi'         => 'nullable',
            'benefit'           => 'nullable',
            'gambar'            => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'persyaratan'       => 'required|array|min:1',
            'persyaratan.*'     => 'required|string',
            'wajib'             => 'required|array',
        ]);

        return DB::transaction(function () use ($request, $validatedData) {
            if ($request->hasFile('gambar')) {
                $validatedData['gambar'] = $request->file('gambar')->store('beasiswa', 'public');
            }

            $beasiswaData = collect($validatedData)->except(['persyaratan', 'wajib'])->toArray();
            $beasiswa = Beasiswa::create($beasiswaData);

            foreach ($request->persyaratan as $index => $namaSyarat) {
                if (!empty($namaSyarat)) {
                    PersyaratanBeasiswa::create([
                        'beasiswa_id'      => $beasiswa->id,
                        'nama_persyaratan' => $namaSyarat,
                        'wajib'            => filter_var($request->wajib[$index] ?? true, FILTER_VALIDATE_BOOLEAN),
                    ]);
                }
            }

            return redirect()->route('admin.beasiswa.index')->with('success', 'Beasiswa dan Persyaratan berhasil diterbitkan');
        });
    }

    // Update data beasiswa
    public function update(Request $request, $id)
    {
        $item = Beasiswa::findOrFail($id);

        $validatedData = $request->validate([
            'nama'              => 'required',
            'sumber_beasiswa'   => 'required',
            'tipe_beasiswa'     => 'required|in:fully_funded,partial_funded,one_shot',
            'status'            => 'required|in:buka,tutup,aktif',
            'periode'           => 'required',
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'required|date|after:tanggal_mulai',
            'kuota'             => 'nullable|integer',
            'deskripsi'         => 'nullable',
            'benefit'           => 'nullable',
            'gambar'            => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'persyaratan'       => 'nullable|array',
            'wajib'             => 'nullable|array',
        ]);

        return DB::transaction(function () use ($request, $validatedData, $item) {
            if ($request->hasFile('gambar')) {
                if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                    Storage::disk('public')->delete($item->gambar);
                }
                $validatedData['gambar'] = $request->file('gambar')->store('beasiswa', 'public');
            }

            $item->update(collect($validatedData)->except(['persyaratan', 'wajib'])->toArray());

            if ($request->has('persyaratan')) {
                $item->persyaratan()->delete();

                foreach ($request->persyaratan as $index => $namaSyarat) {
                    if (!empty($namaSyarat)) {
                        $item->persyaratan()->create([
                            'nama_persyaratan' => $namaSyarat,
                            'wajib'            => filter_var($request->wajib[$index] ?? true, FILTER_VALIDATE_BOOLEAN),
                        ]);
                    }
                }
            }

            return redirect()->route('admin.beasiswa.index')->with('success', 'Data beasiswa berhasil diupdate');
        });
    }

    // Hapus data beasiswa beserta persyaratannya
    public function destroy($id)
    {
        $item = Beasiswa::findOrFail($id);

        return DB::transaction(function () use ($item) {
            if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                Storage::disk('public')->delete($item->gambar);
            }

            $item->persyaratan()->delete();
            $item->delete();

            return back()->with('success', 'Data beasiswa dan persyaratannya berhasil dihapus');
        });
    }
}