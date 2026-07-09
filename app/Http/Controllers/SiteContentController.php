<?php

namespace App\Http\Controllers;

use App\Models\SiteContent;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{
    public function index()
    {
        $contents = SiteContent::all()->groupBy('group');
        return view('site-content.index', compact('contents'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        
        foreach ($data as $key => $value) {
            SiteContent::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->route('site-content.index')->with('success', 'Konten landing page berhasil diperbarui!');
    }
}