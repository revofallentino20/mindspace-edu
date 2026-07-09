@extends('layouts.admin')
@section('title', 'Edit Konten Landing Page')

@section('content')
<form action="/site-content" method="POST">
    @csrf
    @method('POST')

    {{-- Hero Section --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h3 class="text-lg font-bold text-gray-700 mb-4 pb-2 border-b">🦸 Hero Section</h3>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Badge Text</label>
                <input type="text" name="hero_badge" value="{{ $contents['hero'][0]->where('key','hero_badge')->first()?->value ?? '' }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Headline Utama</label>
                <textarea name="hero_headline" rows="2"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">{{ $contents['hero'][0]->where('key','hero_headline')->first()?->value ?? '' }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sub-headline</label>
                <textarea name="hero_subheadline" rows="3"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">{{ $contents['hero'][0]->where('key','hero_subheadline')->first()?->value ?? '' }}</textarea>
            </div>
        </div>
    </div>

    {{-- Stats Section --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h3 class="text-lg font-bold text-gray-700 mb-4 pb-2 border-b">📊 Stats Section</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @for($i = 1; $i <= 4; $i++)
            <div class="border border-gray-100 rounded-xl p-4">
                <p class="text-sm font-semibold text-gray-500 mb-2">Stat {{ $i }}</p>
                <div class="space-y-2">
                    <input type="text" name="stat{{ $i }}_number"
                        value="{{ $contents['stats'][0]->where('key','stat'.$i.'_number')->first()?->value ?? '' }}"
                        placeholder="Angka (contoh: 60%)"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                    <input type="text" name="stat{{ $i }}_desc"
                        value="{{ $contents['stats'][0]->where('key','stat'.$i.'_desc')->first()?->value ?? '' }}"
                        placeholder="Deskripsi"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>
            @endfor
        </div>
    </div>

    {{-- CTA Section --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h3 class="text-lg font-bold text-gray-700 mb-4 pb-2 border-b">📣 CTA Section</h3>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Headline CTA</label>
                <textarea name="cta_headline" rows="2"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">{{ $contents['cta'][0]->where('key','cta_headline')->first()?->value ?? '' }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sub-headline CTA</label>
                <textarea name="cta_subheadline" rows="2"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">{{ $contents['cta'][0]->where('key','cta_subheadline')->first()?->value ?? '' }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Bawah</label>
                <input type="text" name="cta_note"
                    value="{{ $contents['cta'][0]->where('key','cta_note')->first()?->value ?? '' }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
        </div>
    </div>

    <button type="submit" class="w-full bg-primary text-white py-4 rounded-2xl font-bold text-lg hover:bg-purple-700 transition">
        💾 Simpan Perubahan
    </button>
</form>
@endsection