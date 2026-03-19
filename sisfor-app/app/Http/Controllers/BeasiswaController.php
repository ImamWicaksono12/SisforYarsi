<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Services\BeasiswaService;
use App\Http\Requests\BeasiswaRequest;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    protected $beasiswaService;

    public function __construct(BeasiswaService $beasiswaService)
    {
        $this->beasiswaService = $beasiswaService;
    }

    public function index()
    {
        /** 
         */
        $data = Beasiswa::latest()->paginate(10); 
        
        return view('beasiswa.index', compact('data'));
    }

    public function create()
    {
        return view('beasiswa.create');
    }

    public function store(BeasiswaRequest $request)
    {
        $this->beasiswaService->storeBeasiswa($request->validated(), $request->file('gambar'));
        
        return redirect()->route('beasiswa.index')->with('success', 'Beasiswa berhasil diterbitkan.');
    }

    public function edit($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('beasiswa.edit', compact('beasiswa'));
    }

    public function update(BeasiswaRequest $request, $id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        $this->beasiswaService->updateBeasiswa($beasiswa, $request->validated(), $request->file('gambar'));
        
        /**
         */
        return redirect()->route('beasiswa.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        $this->beasiswaService->deleteBeasiswa($beasiswa);
        
        return back()->with('success', 'Data berhasil dihapus.');
    }
}