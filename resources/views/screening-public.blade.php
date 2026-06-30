<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Screening — MindSpace Edu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#0F6E56', secondary: '#1D9E75' } } } }</script>
</head>
<body class="bg-gradient-to-br from-teal-50 to-green-50 min-h-screen p-4 pb-12">

<div class="max-w-2xl mx-auto">
    <!-- Mini Navbar -->
    <div class="flex justify-between items-center py-4 mb-2">
        <a href="/login" class="text-sm border border-teal-300 text-teal-700 px-4 py-2 rounded-full hover:bg-teal-50 transition">
            Login Admin →
        </a>
    </div>

    <!-- Header -->
    <div class="text-center mb-8 pt-2">
        <h1 class="text-2xl font-bold text-gray-800">Mental Health Screening</h1> <p class="text-gray-500 mt-2 text-sm">Kuesioner terstandarisasi PHQ-9 & GAD-7</p>
        <div class="inline-flex items-center gap-2 bg-teal-50 border border-teal-200 text-teal-700 px-4 py-2 rounded-full text-sm font-medium mt-3">
            🔒 Anonim & Aman — identitasmu tidak akan terungkap
        </div>
    </div>

    <form action="/screening" method="POST">
        @csrf

            <!-- Sekolah -->
        <div class="bg-white rounded-2xl shadow p-6 mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Sekolah kamu</label>
            <select name="school_id" required
                class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary text-gray-800">
                <option value="">-- Pilih Sekolah --</option>
                @foreach($schools as $school)
                <option value="{{ $school->id }}">{{ $school->nama }} ({{ $school->kota }})</option>
                @endforeach
            </select>
        </div>

        <!-- Kelas -->
        <div class="bg-white rounded-2xl shadow p-6 mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Kelas kamu</label>
            <input type="text" name="kelas" placeholder="Contoh: XII IPA 1"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary text-gray-800"
                required>
        </div>

        <!-- PHQ-9 -->
        <div class="bg-white rounded-2xl shadow p-6 mb-4">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">PHQ-9</span>
                <h2 class="font-bold text-gray-800">Skala Depresi</h2>
            </div>
            <p class="text-sm text-gray-500 mb-5">Selama <strong>2 minggu terakhir</strong>, seberapa sering kamu terganggu oleh hal-hal berikut?</p>

            @php
            $pilihan = [
                '0' => 'Tidak pernah',
                '1' => 'Beberapa hari',
                '2' => 'Lebih dari separuh hari',
                '3' => 'Hampir setiap hari'
            ];
            $phq_questions = [
                'phq1' => 'Merasa sedih, tertekan, atau tidak punya harapan',
                'phq2' => 'Kurang minat atau semangat dalam melakukan sesuatu',
                'phq3' => 'Sulit tidur, tidur tidak nyenyak, atau tidur terlalu banyak',
                'phq4' => 'Merasa lelah atau kurang berenergi',
                'phq5' => 'Kurang nafsu makan atau makan berlebihan',
                'phq6' => 'Merasa buruk tentang diri sendiri, merasa gagal, atau mengecewakan orang lain',
                'phq7' => 'Sulit berkonsentrasi, misalnya membaca atau menonton TV',
                'phq8' => 'Bergerak atau berbicara sangat lambat, atau sebaliknya gelisah dan susah diam',
                'phq9' => 'Berpikir lebih baik mati atau menyakiti diri sendiri',
            ];
            @endphp

            <div class="space-y-5">
                @foreach($phq_questions as $name => $question)
                <div class="border border-gray-100 rounded-xl p-4">
                    <p class="text-sm font-medium text-gray-700 mb-3">{{ $loop->iteration }}. {{ $question }}</p>
                    <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
                        @foreach($pilihan as $val => $label)
                        <label class="flex flex-col items-center gap-1 cursor-pointer">
                            <input type="radio" name="{{ $name }}" value="{{ $val }}" required
                                class="accent-teal-600 w-4 h-4">
                            <span class="text-xs text-center text-gray-500 leading-tight">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- GAD-7 -->
        <div class="bg-white rounded-2xl shadow p-6 mb-6">
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">GAD-7</span>
                <h2 class="font-bold text-gray-800">Skala Kecemasan</h2>
            </div>
            <p class="text-sm text-gray-500 mb-5">Selama <strong>2 minggu terakhir</strong>, seberapa sering kamu terganggu oleh hal-hal berikut?</p>

            @php
            $gad_questions = [
                'gad1' => 'Merasa gugup, cemas, atau sangat tegang',
                'gad2' => 'Tidak mampu menghentikan atau mengendalikan rasa khawatir',
                'gad3' => 'Terlalu khawatir tentang berbagai hal',
                'gad4' => 'Sulit untuk bersantai',
                'gad5' => 'Sangat gelisah sehingga sulit untuk duduk diam',
                'gad6' => 'Mudah kesal atau jengkel',
                'gad7' => 'Merasa takut seolah-olah sesuatu yang buruk akan terjadi',
            ];
            @endphp

            <div class="space-y-5">
                @foreach($gad_questions as $name => $question)
                <div class="border border-gray-100 rounded-xl p-4">
                    <p class="text-sm font-medium text-gray-700 mb-3">{{ $loop->iteration }}. {{ $question }}</p>
                    <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
                        @foreach($pilihan as $val => $label)
                        <label class="flex flex-col items-center gap-1 cursor-pointer">
                            <input type="radio" name="{{ $name }}" value="{{ $val }}" required
                                class="accent-teal-600 w-4 h-4">
                            <span class="text-xs text-center text-gray-500 leading-tight">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <button type="submit"
            class="w-full bg-primary text-white py-4 rounded-2xl font-bold text-lg hover:bg-teal-800 transition">
            Kirim Screening Saya →
        </button>
        <p class="text-center text-xs text-gray-400 mt-3">Data kamu 100% anonim dan tidak dapat dilacak</p>
    </form>

    <div class="text-center mt-6">
        <a href="/" class="text-sm text-gray-400 hover:text-teal-600">← Kembali ke beranda</a>
    </div>
</div>

</body>
</html>