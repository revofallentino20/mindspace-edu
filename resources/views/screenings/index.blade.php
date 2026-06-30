@extends('layouts.admin')
@section('title', 'Data Screening')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
    <h3 class="text-lg font-semibold text-gray-700">Daftar Screening Siswa</h3>
    <div class="flex gap-3">
        <a href="/screenings/export/pdf" class="bg-red-500 text-white px-4 py-2 rounded-xl hover:bg-red-600 transition text-sm">
            📄 Export PDF
        </a>
        <a href="/screenings/create" class="bg-primary text-white px-4 py-2 rounded-xl hover:bg-purple-700 transition text-sm">
            + Tambah Manual
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow overflow-x-auto">
    <table class="w-full text-sm min-w-[700px]">
        <thead class="bg-primary text-white">
            <tr>
                <th class="px-4 py-4 text-left">Kelas</th>
                <th class="px-4 py-4 text-left">PHQ-9 (Depresi)</th>
                <th class="px-4 py-4 text-left">GAD-7 (Cemas)</th>
                <th class="px-4 py-4 text-left">Kategori Depresi</th>
                <th class="px-4 py-4 text-left">Kategori Cemas</th>
                <th class="px-4 py-4 text-left">Status</th>
                <th class="px-4 py-4 text-left">Tanggal</th>
                <th class="px-4 py-4 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($screenings as $s)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-4 font-medium">{{ $s->kelas }}</td>
                <td class="px-4 py-4">
                    <span class="font-bold {{ $s->skor_phq >= 15 ? 'text-red-500' : ($s->skor_phq >= 10 ? 'text-yellow-500' : 'text-green-500') }}">
                        {{ $s->skor_phq ?? '-' }}/27
                    </span>
                </td>
                <td class="px-4 py-4">
                    <span class="font-bold {{ $s->skor_gad >= 15 ? 'text-red-500' : ($s->skor_gad >= 10 ? 'text-yellow-500' : 'text-green-500') }}">
                        {{ $s->skor_gad ?? '-' }}/21
                    </span>
                </td>
                <td class="px-4 py-4">
                    @php
                    $phq_label = [
                        'minimal' => ['Minimal', 'bg-green-100 text-green-600'],
                        'ringan' => ['Ringan', 'bg-blue-100 text-blue-600'],
                        'sedang' => ['Sedang', 'bg-yellow-100 text-yellow-600'],
                        'cukup_berat' => ['Cukup Berat', 'bg-orange-100 text-orange-600'],
                        'berat' => ['Berat', 'bg-red-100 text-red-600'],
                    ];
                    $phq = $phq_label[$s->kategori_phq] ?? ['Unknown', 'bg-gray-100 text-gray-600'];
                    @endphp
                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $phq[1] }}">{{ $phq[0] }}</span>
                </td>
                <td class="px-4 py-4">
                    @php
                    $gad_label = [
                        'minimal' => ['Minimal', 'bg-green-100 text-green-600'],
                        'ringan' => ['Ringan', 'bg-blue-100 text-blue-600'],
                        'sedang' => ['Sedang', 'bg-yellow-100 text-yellow-600'],
                        'berat' => ['Berat', 'bg-red-100 text-red-600'],
                    ];
                    $gad = $gad_label[$s->kategori_gad] ?? ['Unknown', 'bg-gray-100 text-gray-600'];
                    @endphp
                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $gad[1] }}">{{ $gad[0] }}</span>
                </td>
                <td class="px-4 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $s->status === 'tinggi' ? 'bg-red-100 text-red-600' : '' }}
                        {{ $s->status === 'sedang' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $s->status === 'rendah' ? 'bg-green-100 text-green-600' : '' }}">
                        {{ ucfirst($s->status) }}
                    </span>
                </td>
                <td class="px-4 py-4 text-gray-400">{{ $s->created_at->format('d M Y') }}</td>
                <td class="px-4 py-4">
                    <form action="/screenings/{{ $s->id }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline text-xs">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-4 py-8 text-center text-gray-400">Belum ada data screening.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-4">{{ $screenings->links() }}</div>
</div>
@endsection