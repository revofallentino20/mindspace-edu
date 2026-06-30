@extends('layouts.admin')
@section('title', 'Data Appointment')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h3 class="text-lg font-semibold text-gray-700">Daftar Appointment</h3>
    <a href="/appointments/create" class="bg-secondary text-white px-5 py-2 rounded-xl hover:bg-yellow-500 transition">
        + Tambah
    </a>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-primary text-white">
            <tr>
                <th class="px-6 py-4 text-left">Nama Siswa</th>
                <th class="px-6 py-4 text-left">Kelas</th>
                <th class="px-6 py-4 text-left">Tanggal</th>
                <th class="px-6 py-4 text-left">Jam</th>
                <th class="px-6 py-4 text-left">Jenis</th>
                <th class="px-6 py-4 text-left">Status</th>
                <th class="px-6 py-4 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($appointments as $a)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $a->nama_siswa }}</td>
                <td class="px-6 py-4">{{ $a->kelas }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}</td>
                <td class="px-6 py-4">{{ $a->jam }}</td>
                <td class="px-6 py-4">{{ $a->jenis === 'tatap_muka' ? 'Tatap Muka' : 'Daring' }}</td>
                <td class="px-6 py-4">
                    <form action="/appointments/{{ $a->id }}" method="POST">
                        @csrf @method('PUT')
                        <select name="status" onchange="this.form.submit()"
                            class="text-xs border rounded-lg px-2 py-1
                            {{ $a->status === 'pending' ? 'border-yellow-400 text-yellow-600' : '' }}
                            {{ $a->status === 'dikonfirmasi' ? 'border-blue-400 text-blue-600' : '' }}
                            {{ $a->status === 'selesai' ? 'border-green-400 text-green-600' : '' }}">
                            <option value="pending" {{ $a->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="dikonfirmasi" {{ $a->status === 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="selesai" {{ $a->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>
                </td>
                <td class="px-6 py-4">
                    <form action="/appointments/{{ $a->id }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline text-xs">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-8 text-center text-gray-400">Belum ada data appointment.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">{{ $appointments->links() }}</div>
</div>
@endsection