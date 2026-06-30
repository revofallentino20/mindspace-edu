@extends('layouts.admin')
@section('title', 'Manajemen Sekolah')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
    <h3 class="text-lg font-semibold text-gray-700">Daftar Sekolah Terdaftar</h3>
    <a href="/schools/create" class="bg-primary text-white px-4 py-2 rounded-xl hover:bg-purple-700 transition text-sm">
        + Tambah Sekolah
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-primary">
        <p class="text-sm text-gray-500">Total Sekolah</p>
        <p class="text-4xl font-bold text-primary mt-1">{{ $schools->count() }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-green-400">
        <p class="text-sm text-gray-500">Sekolah Aktif</p>
        <p class="text-4xl font-bold text-green-500 mt-1">{{ $schools->where('aktif', true)->count() }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-secondary">
        <p class="text-sm text-gray-500">Total Screening</p>
        <p class="text-4xl font-bold text-secondary mt-1">{{ $schools->sum('screenings_count') }}</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow overflow-x-auto">
    <table class="w-full text-sm min-w-[600px]">
        <thead class="bg-primary text-white">
            <tr>
                <th class="px-4 py-4 text-left">Nama Sekolah</th>
                <th class="px-4 py-4 text-left">Kode</th>
                <th class="px-4 py-4 text-left">Kota</th>
                <th class="px-4 py-4 text-left">Jenjang</th>
                <th class="px-4 py-4 text-left">Screening</th>
                <th class="px-4 py-4 text-left">Status</th>
                <th class="px-4 py-4 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($schools as $school)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-4 font-medium">{{ $school->nama }}</td>
                <td class="px-4 py-4 text-gray-500 font-mono text-xs">{{ $school->kode }}</td>
                <td class="px-4 py-4">{{ $school->kota ?? '-' }}</td>
                <td class="px-4 py-4">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-600">
                        {{ $school->jenjang }}
                    </span>
                </td>
                <td class="px-4 py-4 font-bold text-primary">{{ $school->screenings_count }}</td>
                <td class="px-4 py-4">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $school->aktif ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                        {{ $school->aktif ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="px-4 py-4">
                    <form action="/schools/{{ $school->id }}" method="POST" onsubmit="return confirm('Hapus sekolah ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline text-xs">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-4 py-8 text-center text-gray-400">Belum ada sekolah terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection