<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isSuperAdmin()) {
            $appointments = Appointment::latest()->paginate(10);
        } else {
            $appointments = Appointment::where('school_id', $user->school_id)->latest()->paginate(10);
        }
        
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('appointments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required|string',
            'kelas' => 'required|string',
            'kontak' => 'nullable|string',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'jenis' => 'required|in:tatap_muka,daring',
            'keluhan' => 'nullable|string',
        ]);

        $validated['status'] = 'pending';
        $validated['school_id'] = auth()->user()->school_id;
        Appointment::create($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment berhasil dibuat.');
    }

    public function update(Request $request, Appointment $appointment)
    {
        $appointment->update(['status' => $request->status]);
        return redirect()->route('appointments.index')->with('success', 'Status berhasil diupdate.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Data berhasil dihapus.');
    }
}