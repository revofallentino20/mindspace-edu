@extends('layouts.admin')
@section('title', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-primary">
        <p class="text-sm text-gray-500">Total Screening</p>
        <p class="text-4xl font-bold text-primary mt-1">{{ $totalScreening }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-secondary">
        <p class="text-sm text-gray-500">Total Appointment</p>
        <p class="text-4xl font-bold text-secondary mt-1">{{ $totalAppointment }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-red-400">
        <p class="text-sm text-gray-500">Appointment Pending</p>
        <p class="text-4xl font-bold text-red-400 mt-1">{{ $pending }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-red-50 rounded-2xl shadow p-6 text-center">
        <p class="text-sm text-gray-500">Status Tinggi</p>
        <p class="text-3xl font-bold text-red-500 mt-1">{{ $tinggi }}</p>
    </div>
    <div class="bg-yellow-50 rounded-2xl shadow p-6 text-center">
        <p class="text-sm text-gray-500">Status Sedang</p>
        <p class="text-3xl font-bold text-yellow-500 mt-1">{{ $sedang }}</p>
    </div>
    <div class="bg-green-50 rounded-2xl shadow p-6 text-center">
        <p class="text-sm text-gray-500">Status Rendah</p>
        <p class="text-3xl font-bold text-green-500 mt-1">{{ $rendah }}</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow p-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Quick Actions</h3>
    <div class="flex gap-4">
        <a href="/screenings/create" class="bg-primary text-white px-6 py-3 rounded-xl hover:bg-purple-700 transition">
            + Tambah Screening
        </a>
        <a href="/appointments/create" class="bg-secondary text-white px-6 py-3 rounded-xl hover:bg-yellow-500 transition">
            + Tambah Appointment
        </a>
    </div>
<div class="bg-white rounded-2xl shadow p-6 mt-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Distribusi Status Screening per Kelas</h3>
    <canvas id="screeningChart" height="100"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('screeningChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [
                {
                    label: 'Tinggi',
                    data: {!! json_encode($chartTinggi) !!},
                    backgroundColor: '#FCA5A5',
                    borderRadius: 6,
                },
                {
                    label: 'Sedang',
                    data: {!! json_encode($chartSedang) !!},
                    backgroundColor: '#FCD34D',
                    borderRadius: 6,
                },
                {
                    label: 'Rendah',
                    data: {!! json_encode($chartRendah) !!},
                    backgroundColor: '#6EE7B7',
                    borderRadius: 6,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { x: { stacked: false }, y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });
</script>
</div>
@endsection