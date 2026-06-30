<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use Illuminate\Http\Request;

class PublicScreeningController extends Controller
{
    public function consent()
    {
        return view('screening-consent');
    }

    public function index()
    {
        $schools = \App\Models\School::where('aktif', true)->get();
        return view('screening-public', compact('schools'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas' => 'required|string',
            'school_id' => 'required|exists:schools,id',
            'phq1' => 'required|integer|min:0|max:3',
            'phq2' => 'required|integer|min:0|max:3',
            'phq3' => 'required|integer|min:0|max:3',
            'phq4' => 'required|integer|min:0|max:3',
            'phq5' => 'required|integer|min:0|max:3',
            'phq6' => 'required|integer|min:0|max:3',
            'phq7' => 'required|integer|min:0|max:3',
            'phq8' => 'required|integer|min:0|max:3',
            'phq9' => 'required|integer|min:0|max:3',
            'gad1' => 'required|integer|min:0|max:3',
            'gad2' => 'required|integer|min:0|max:3',
            'gad3' => 'required|integer|min:0|max:3',
            'gad4' => 'required|integer|min:0|max:3',
            'gad5' => 'required|integer|min:0|max:3',
            'gad6' => 'required|integer|min:0|max:3',
            'gad7' => 'required|integer|min:0|max:3',
        ]);

        $skor_phq = $validated['phq1'] + $validated['phq2'] + $validated['phq3'] +
                    $validated['phq4'] + $validated['phq5'] + $validated['phq6'] +
                    $validated['phq7'] + $validated['phq8'] + $validated['phq9'];

        $skor_gad = $validated['gad1'] + $validated['gad2'] + $validated['gad3'] +
                    $validated['gad4'] + $validated['gad5'] + $validated['gad6'] +
                    $validated['gad7'];

        if ($skor_phq <= 4) $kategori_phq = 'minimal';
        elseif ($skor_phq <= 9) $kategori_phq = 'ringan';
        elseif ($skor_phq <= 14) $kategori_phq = 'sedang';
        elseif ($skor_phq <= 19) $kategori_phq = 'cukup_berat';
        else $kategori_phq = 'berat';

        if ($skor_gad <= 4) $kategori_gad = 'minimal';
        elseif ($skor_gad <= 9) $kategori_gad = 'ringan';
        elseif ($skor_gad <= 14) $kategori_gad = 'sedang';
        else $kategori_gad = 'berat';

        $status_phq = $skor_phq >= 15 ? 'tinggi' : ($skor_phq >= 10 ? 'sedang' : 'rendah');
        $status_gad = $skor_gad >= 15 ? 'tinggi' : ($skor_gad >= 10 ? 'sedang' : 'rendah');
        $status = ($status_phq === 'tinggi' || $status_gad === 'tinggi') ? 'tinggi' :
                  (($status_phq === 'sedang' || $status_gad === 'sedang') ? 'sedang' : 'rendah');

        Screening::create([
            'kelas'        => $validated['kelas'],
            'school_id'    => $validated['school_id'],
            'phq1'         => $validated['phq1'],
            'phq2'         => $validated['phq2'],
            'phq3'         => $validated['phq3'],
            'phq4'         => $validated['phq4'],
            'phq5'         => $validated['phq5'],
            'phq6'         => $validated['phq6'],
            'phq7'         => $validated['phq7'],
            'phq8'         => $validated['phq8'],
            'phq9'         => $validated['phq9'],
            'skor_phq'     => $skor_phq,
            'gad1'         => $validated['gad1'],
            'gad2'         => $validated['gad2'],
            'gad3'         => $validated['gad3'],
            'gad4'         => $validated['gad4'],
            'gad5'         => $validated['gad5'],
            'gad6'         => $validated['gad6'],
            'gad7'         => $validated['gad7'],
            'skor_gad'     => $skor_gad,
            'kategori_phq' => $kategori_phq,
            'kategori_gad' => $kategori_gad,
            'status'       => $status,
            'skor_stres'   => 0,
            'skor_cemas'   => $skor_gad,
            'skor_depresi' => $skor_phq,
            'catatan'      => null,
        ]);

        return redirect()->route('screening.result', [
            'status'       => $status,
            'skor_phq'     => $skor_phq,
            'skor_gad'     => $skor_gad,
            'kategori_phq' => $kategori_phq,
            'kategori_gad' => $kategori_gad,
            'phq9'         => $validated['phq9'],
        ]);
    }

    public function result(Request $request)
    {
        $status       = $request->query('status', 'rendah');
        $skor_phq     = $request->query('skor_phq', 0);
        $skor_gad     = $request->query('skor_gad', 0);
        $kategori_phq = $request->query('kategori_phq', 'minimal');
        $kategori_gad = $request->query('kategori_gad', 'minimal');
        $phq9         = $request->query('phq9', 0);

        return view('screening-result', compact(
            'status', 'skor_phq', 'skor_gad', 'kategori_phq', 'kategori_gad', 'phq9'
        ));
    }
}