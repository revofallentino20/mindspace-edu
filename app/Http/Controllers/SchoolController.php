<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::withCount(['screenings', 'appointments'])->get();
        return view('schools.index', compact('schools'));
    }

    public function create()
    {
        return view('schools.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string',
            'kode'    => 'required|string|unique:schools',
            'alamat'  => 'nullable|string',
            'kota'    => 'nullable|string',
            'kontak'  => 'nullable|string',
            'email'   => 'nullable|email',
            'jenjang' => 'required|in:SMP,SMA,SMK,Perguruan Tinggi',
        ]);

        $validated['aktif'] = true;
        School::create($validated);

        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil ditambahkan.');
    }

    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil dihapus.');
    }
}