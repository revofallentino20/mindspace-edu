<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Screening — MindSpace Edu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#0F6E56' } } } }</script>
</head>
<body class="bg-gradient-to-br from-teal-50 to-green-50 min-h-screen flex items-center justify-center p-4">

<div class="max-w-lg w-full">
    <div class="flex justify-between items-center py-4 mb-4">
        <a href="/" class="text-lg font-bold text-primary">MindSpace<span class="text-green-400">.</span>Edu</a>
        <a href="/login" class="text-sm border border-teal-300 text-teal-700 px-4 py-2 rounded-full hover:bg-teal-50 transition">
            Login Admin →
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-xl p-8">
            {{-- Protokol Krisis --}}
    @if($skor_phq >= 15 || request()->query('phq9') >= 1)
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
        <div class="text-center mb-6">
            <div class="text-4xl mb-3">📋</div>
            <h1 class="text-2xl font-bold text-gray-800">Informed Consent</h1>
            <p class="text-gray-500 text-sm mt-2">Baca dan setujui sebelum mengisi screening</p>
        </div>

        <div class="bg-teal-50 rounded-2xl p-5 mb-6 text-sm text-gray-700 space-y-3">
            <p><strong>Tentang Screening Ini:</strong></p>
            <ul class="space-y-2 text-gray-600">
                <li>✦ Screening ini menggunakan instrumen <strong>PHQ-9</strong> (depresi) dan <strong>GAD-7</strong> (kecemasan) yang terstandarisasi secara klinis.</li>
                <li>✦ Hasil screening ini <strong>bukan diagnosis medis</strong> dan tidak menggantikan konsultasi dengan profesional kesehatan mental.</li>
                <li>✦ Data yang kamu isi bersifat <strong>anonim</strong> — tidak ada nama atau identitas yang dicatat.</li>
                <li>✦ Data hanya digunakan untuk membantu Guru BK memahami kondisi kesehatan mental siswa secara kolektif.</li>
                <li>✦ Jika kamu dalam kondisi darurat atau memiliki pikiran untuk menyakiti diri sendiri, segera hubungi Guru BK atau orang terpercaya.</li>
            </ul>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-4 mb-6 text-sm">
            <p class="text-yellow-800 font-semibold mb-1">⚠️ Perhatian</p>
            <p class="text-yellow-700">Screening ini dirancang untuk siswa usia <strong>13 tahun ke atas</strong>. Jika kamu berusia di bawah 13 tahun, konsultasikan dengan Guru BK secara langsung.</p>
        </div>

        <div class="flex items-start gap-3 mb-6">
            <input type="checkbox" id="agree" class="mt-1 w-4 h-4 accent-teal-600 cursor-pointer">
            <label for="agree" class="text-sm text-gray-600 cursor-pointer">
                Saya telah membaca dan memahami informasi di atas. Saya menyetujui untuk mengisi screening ini secara sukarela dan jujur.
            </label>
        </div>

        <button id="lanjutBtn" onclick="lanjut()"
            class="w-full bg-gray-300 text-gray-500 py-4 rounded-2xl font-bold text-lg cursor-not-allowed transition"
            disabled>
            Lanjut ke Screening →
        </button>

        <p class="text-center text-xs text-gray-400 mt-4">
            Butuh bantuan segera? Hubungi Into The Light Indonesia: <strong>119 ext 8</strong>
        </p>
    </div>

    <div class="text-center mt-6">
        <a href="/" class="text-sm text-gray-400 hover:text-teal-600">← Kembali ke beranda</a>
    </div>
</div>

<script>
    const checkbox = document.getElementById('agree');
    const btn = document.getElementById('lanjutBtn');

    checkbox.addEventListener('change', function() {
        if (this.checked) {
            btn.disabled = false;
            btn.className = 'w-full bg-primary text-white py-4 rounded-2xl font-bold text-lg hover:bg-teal-800 transition cursor-pointer';
        } else {
            btn.disabled = true;
            btn.className = 'w-full bg-gray-300 text-gray-500 py-4 rounded-2xl font-bold text-lg cursor-not-allowed transition';
        }
    });

    function lanjut() {
        window.location.href = '/screening/form';
    }
</script>

</body>
</html>