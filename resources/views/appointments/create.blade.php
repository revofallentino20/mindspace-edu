@extends('layouts.admin')
@section('title', 'Tambah Appointment')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow p-8">
    <form action="/appointments" method="POST" class="space-y-5">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                <input type="text" name="nama_siswa"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <input type="text" name="kelas" placeholder="Contoh: XI IPS 2"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kontak (opsional)</label>
            <input type="text" name="kontak" placeholder="No. HP atau email"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="tanggal"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jam</label>
                <input type="time" name="jam"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Konsultasi</label>
            <select name="jenis"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="tatap_muka">Tatap Muka</option>
                <option value="daring">Daring</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Keluhan (opsional)</label>
            <textarea name="keluhan" rows="3"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="bg-secondary text-white px-8 py-3 rounded-xl hover:bg-yellow-500 transition">
                Simpan
            </button>
            <a href="/appointments" class="px-8 py-3 rounded-xl border border-gray-300 hover:bg-gray-50 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection