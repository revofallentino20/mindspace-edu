<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Screening — MindSpace Edu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#0F6E56' } } } }</script>
</head>
<body class="bg-gradient-to-br from-teal-50 to-green-50 min-h-screen flex items-center justify-center p-4">

<div class="max-w-lg w-full">
    <div class="text-center mb-6">
        <a href="/" class="text-2xl font-bold text-primary">MindSpace<span class="text-green-400">.</span>Edu</a>
    </div>

    <div class="bg-white rounded-3xl shadow-xl p-8">
        <h2 class="text-xl font-bold text-gray-800 text-center mb-6">Hasil Screening Kamu</h2>

        {{-- Protokol Krisis --}}
        @if($skor_phq >= 15 || $phq9 >= 1)
        <div class="bg-red-600 rounded-2xl p-5 mb-6 text-white">
            <p class="font-bold text-lg mb-2">🚨 Perhatian Penting</p>
            <p class="text-sm mb-3">Hasil screeningmu menunjukkan kamu mungkin membutuhkan bantuan segera. Kamu tidak sendirian.</p>
            <div class="bg-red-700 rounded-xl p-4 space-y-2 text-sm">
                <p>📞 <strong>Into The Light Indonesia:</strong> 119 ext 8</p>
                <p>📞 <strong>Yayasan Pulih:</strong> (021) 788-42580</p>
                <p>🏫 <strong>Segera temui Guru BK</strong> di sekolahmu</p>
            </div>
            <p class="text-xs mt-3 text-red-200">Informasi ini telah diteruskan ke sistem BK sekolahmu untuk tindak lanjut.</p>
        </div>
        @endif

        <!-- PHQ-9 Result -->
        <div class="mb-5 p-5 rounded-2xl
            {{ in_array($kategori_phq, ['cukup_berat','berat']) ? 'bg-red-50' : ($kategori_phq === 'sedang' ? 'bg-yellow-50' : ($kategori_phq === 'ringan' ? 'bg-blue-50' : 'bg-green-50')) }}">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-bold text-gray-700">PHQ-9 — Depresi</span>
                <span class="text-lg font-bold
                    {{ in_array($kategori_phq, ['cukup_berat','berat']) ? 'text-red-500' : ($kategori_phq === 'sedang' ? 'text-yellow-500' : ($kategori_phq === 'ringan' ? 'text-blue-500' : 'text-green-500')) }}">
                    {{ $skor_phq }}/27
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                <div class="h-2 rounded-full
                    {{ in_array($kategori_phq, ['cukup_berat','berat']) ? 'bg-red-400' : ($kategori_phq === 'sedang' ? 'bg-yellow-400' : ($kategori_phq === 'ringan' ? 'bg-blue-400' : 'bg-green-400')) }}"
                    style="width: {{ ($skor_phq/27)*100 }}%"></div>
            </div>
            <p class="text-sm font-semibold
                {{ in_array($kategori_phq, ['cukup_berat','berat']) ? 'text-red-600' : ($kategori_phq === 'sedang' ? 'text-yellow-600' : ($kategori_phq === 'ringan' ? 'text-blue-600' : 'text-green-600')) }}">
                {{ $kategori_phq === 'minimal' ? 'Minimal / Tidak Ada' :
                   ($kategori_phq === 'ringan' ? 'Ringan' :
                   ($kategori_phq === 'sedang' ? 'Sedang' :
                   ($kategori_phq === 'cukup_berat' ? 'Cukup Berat' : 'Berat'))) }}
            </p>
        </div>

        <!-- GAD-7 Result -->
        <div class="mb-6 p-5 rounded-2xl
            {{ $kategori_gad === 'berat' ? 'bg-red-50' : ($kategori_gad === 'sedang' ? 'bg-yellow-50' : ($kategori_gad === 'ringan' ? 'bg-blue-50' : 'bg-green-50')) }}">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-bold text-gray-700">GAD-7 — Kecemasan</span>
                <span class="text-lg font-bold
                    {{ $kategori_gad === 'berat' ? 'text-red-500' : ($kategori_gad === 'sedang' ? 'text-yellow-500' : ($kategori_gad === 'ringan' ? 'text-blue-500' : 'text-green-500')) }}">
                    {{ $skor_gad }}/21
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                <div class="h-2 rounded-full
                    {{ $kategori_gad === 'berat' ? 'bg-red-400' : ($kategori_gad === 'sedang' ? 'bg-yellow-400' : ($kategori_gad === 'ringan' ? 'bg-blue-400' : 'bg-green-400')) }}"
                    style="width: {{ ($skor_gad/21)*100 }}%"></div>
            </div>
            <p class="text-sm font-semibold
                {{ $kategori_gad === 'berat' ? 'text-red-600' : ($kategori_gad === 'sedang' ? 'text-yellow-600' : ($kategori_gad === 'ringan' ? 'text-blue-600' : 'text-green-600')) }}">
                {{ $kategori_gad === 'minimal' ? 'Minimal / Tidak Ada' :
                   ($kategori_gad === 'ringan' ? 'Ringan' :
                   ($kategori_gad === 'sedang' ? 'Sedang' : 'Berat')) }}
            </p>
        </div>

        <!-- Saran -->
        @if($skor_phq >= 15 || $phq9 >= 1)
        {{-- sudah ditangani oleh protokol krisis di atas --}}
        @elseif($status === 'tinggi')
        <div class="bg-red-50 rounded-2xl p-5 mb-6">
            <p class="text-sm font-bold text-red-700 mb-2">⚠️ Perlu Perhatian Segera</p>
            <ul class="text-sm text-red-600 space-y-1">
                <li>✦ Segera bicarakan dengan Guru BK atau konselor</li>
                <li>✦ Jangan hadapi ini sendirian</li>
                <li>✦ Ceritakan pada orang yang kamu percaya</li>
            </ul>
        </div>
        @elseif($status === 'sedang')
        <div class="bg-yellow-50 rounded-2xl p-5 mb-6">
            <p class="text-sm font-bold text-yellow-700 mb-2">🌤️ Perlu Diperhatikan</p>
            <ul class="text-sm text-yellow-600 space-y-1">
                <li>✦ Pertimbangkan untuk berbicara dengan Guru BK</li>
                <li>✦ Jaga keseimbangan belajar dan istirahat</li>
                <li>✦ Lakukan aktivitas yang kamu sukai</li>
            </ul>
        </div>
        @else
        <div class="bg-green-50 rounded-2xl p-5 mb-6">
            <p class="text-sm font-bold text-green-700 mb-2">🌿 Kondisi Baik!</p>
            <ul class="text-sm text-green-600 space-y-1">
                <li>✦ Pertahankan pola hidup sehat</li>
                <li>✦ Tetap jaga komunikasi dengan orang sekitar</li>
                <li>✦ Lakukan screening secara berkala</li>
            </ul>
        </div>
        @endif

        <div class="text-xs text-gray-400 text-center mb-5 p-3 bg-gray-50 rounded-xl">
            <strong>Catatan:</strong> Hasil ini bukan diagnosis medis. Untuk penanganan lebih lanjut, konsultasikan dengan profesional kesehatan mental.
        </div>

        <a href="/screening" class="block w-full text-center bg-primary text-white py-3 rounded-2xl font-bold hover:bg-teal-800 transition">
            Isi Ulang Screening
        </a>
    </div>

    <div class="text-center mt-6">
        <a href="/" class="text-sm text-gray-400 hover:text-teal-600">← Kembali ke beranda</a>
    </div>
</div>

</body>
</html> 