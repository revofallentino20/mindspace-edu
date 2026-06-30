<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    public function index()
    {
        $screenings = Screening::latest()->paginate(10);
        return view('screenings.index', compact('screenings'));
    }

    public function create()
    {
        return view('screenings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas' => 'required|string',
            'skor_stres' => 'required|integer|min:0|max:100',
            'skor_cemas' => 'required|integer|min:0|max:100',
            'skor_depresi' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        $rata = ($validated['skor_stres'] + $validated['skor_cemas'] + $validated['skor_depresi']) / 3;
        $validated['status'] = $rata >= 70 ? 'tinggi' : ($rata >= 40 ? 'sedang' : 'rendah');

        Screening::create($validated);
        return redirect()->route('screenings.index')->with('success', 'Data screening berhasil ditambahkan.');
    }

    public function destroy(Screening $screening)
    {
        $screening->delete();
        return redirect()->route('screenings.index')->with('success', 'Data berhasil dihapus.');
    }
    public function exportPdf()
{
    $screenings = Screening::all();
    $tinggi = Screening::where('status', 'tinggi')->count();
    $sedang = Screening::where('status', 'sedang')->count();
    $rendah = Screening::where('status', 'rendah')->count();

    $pdf = \PDF::loadView('screenings.pdf', compact('screenings', 'tinggi', 'sedang', 'rendah'));
    return $pdf->download('Laporan_Screening_' . now()->format('Y-m-d') . '.pdf');
}
}