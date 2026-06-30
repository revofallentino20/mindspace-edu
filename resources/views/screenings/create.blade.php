@extends('layouts.admin')
@section('title', 'Tambah Screening')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow p-8">
    <form action="/screenings" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
            <input type="text" name="kelas" placeholder="Contoh: XII IPA 1"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Skor Stres (0-100)</label>
                <input type="number" name="skor_stres" min="0" max="100"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Skor Cemas (0-100)</label>
                <input type="number" name="skor_cemas" min="0" max="100"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Skor Depresi (0-100)</label>
                <input type="number" name="skor_depresi" min="0" max="100"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (opsional)</label>
            <textarea name="catatan" rows="3"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl hover:bg-purple-700 transition">
                Simpan
            </button>
            <a href="/screenings" class="px-8 py-3 rounded-xl border border-gray-300 hover:bg-gray-50 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection