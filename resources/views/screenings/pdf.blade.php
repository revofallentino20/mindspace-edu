<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Mental Health Screening</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; font-size: 11px; }
        h1 { color: #0F6E56; text-align: center; font-size: 16px; margin-bottom: 5px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #0F6E56; padding-bottom: 12px; }
        .header p { margin: 3px 0; color: #666; font-size: 11px; }
        .stats { display: flex; gap: 10px; margin: 15px 0; justify-content: center; }
        .stat-box { border: 1px solid #ddd; padding: 10px 15px; border-radius: 8px; text-align: center; min-width: 100px; }
        .stat-num { font-size: 22px; font-weight: bold; color: #0F6E56; }
        .stat-lbl { font-size: 10px; color: #666; margin-top: 3px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background: #0F6E56; color: white; padding: 8px 6px; text-align: left; font-size: 10px; }
        td { padding: 7px 6px; border-bottom: 1px solid #eee; font-size: 10px; }
        tr:nth-child(even) { background: #f9f9f9; }
        .footer { margin-top: 20px; text-align: center; font-size: 10px; color: #999; border-top: 1px solid #ddd; padding-top: 10px; }
        .badge { display: inline-block; padding: 2px 7px; border-radius: 10px; font-size: 9px; font-weight: bold; }
        .badge-minimal { background: #D1FAE5; color: #065F46; }
        .badge-ringan { background: #DBEAFE; color: #1E40AF; }
        .badge-sedang { background: #FEF3C7; color: #92400E; }
        .badge-cukup_berat { background: #FFEDD5; color: #9A3412; }
        .badge-berat { background: #FEE2E2; color: #991B1B; }
        .status-tinggi { background: #FCA5A5; color: #7F1D1D; padding: 2px 7px; border-radius: 10px; font-weight: bold; }
        .status-sedang { background: #FCD34D; color: #78350F; padding: 2px 7px; border-radius: 10px; font-weight: bold; }
        .status-rendah { background: #6EE7B7; color: #064E3B; padding: 2px 7px; border-radius: 10px; font-weight: bold; }
    </style>
</head>
<body>

<div class="header">
    <h1>Laporan Mental Health Screening</h1>
    <p>MindSpace Edu — Dashboard Bimbingan Konseling</p>
    <p>Menggunakan Instrumen PHQ-9 (Depresi) & GAD-7 (Kecemasan)</p>
    <p>Tanggal: {{ now()->format('d M Y H:i') }}</p>
</div>

<div class="stats">
    <div class="stat-box">
        <div class="stat-num">{{ count($screenings) }}</div>
        <div class="stat-lbl">Total Screening</div>
    </div>
    <div class="stat-box">
        <div class="stat-num" style="color:#DC2626;">{{ $tinggi }}</div>
        <div class="stat-lbl">Status Tinggi</div>
    </div>
    <div class="stat-box">
        <div class="stat-num" style="color:#D97706;">{{ $sedang }}</div>
        <div class="stat-lbl">Status Sedang</div>
    </div>
    <div class="stat-box">
        <div class="stat-num" style="color:#059669;">{{ $rendah }}</div>
        <div class="stat-lbl">Status Rendah</div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>Kelas</th>
            <th>PHQ-9 Score</th>
            <th>Kategori Depresi</th>
            <th>GAD-7 Score</th>
            <th>Kategori Cemas</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($screenings as $s)
        <tr>
            <td>{{ $s->kelas }}</td>
            <td style="text-align:center; font-weight:bold;">{{ $s->skor_phq ?? '-' }}/27</td>
            <td>
                @if($s->kategori_phq)
                <span class="badge badge-{{ $s->kategori_phq }}">
                    {{ $s->kategori_phq === 'minimal' ? 'Minimal' :
                       ($s->kategori_phq === 'ringan' ? 'Ringan' :
                       ($s->kategori_phq === 'sedang' ? 'Sedang' :
                       ($s->kategori_phq === 'cukup_berat' ? 'Cukup Berat' : 'Berat'))) }}
                </span>
                @else
                <span class="badge badge-minimal">-</span>
                @endif
            </td>
            <td style="text-align:center; font-weight:bold;">{{ $s->skor_gad ?? '-' }}/21</td>
            <td>
                @if($s->kategori_gad)
                <span class="badge badge-{{ $s->kategori_gad }}">
                    {{ $s->kategori_gad === 'minimal' ? 'Minimal' :
                       ($s->kategori_gad === 'ringan' ? 'Ringan' :
                       ($s->kategori_gad === 'sedang' ? 'Sedang' : 'Berat')) }}
                </span>
                @else
                <span class="badge badge-minimal">-</span>
                @endif
            </td>
            <td><span class="status-{{ $s->status }}">{{ ucfirst($s->status) }}</span></td>
            <td>{{ $s->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    <p>Dokumen ini dibuat secara otomatis oleh sistem MindSpace Edu</p>
    <p>Instrumen: PHQ-9 (Patient Health Questionnaire-9) & GAD-7 (Generalized Anxiety Disorder-7)</p>
    <p>© 2026 MindSpace Edu — Revo Fallentino | NIM 22.11.5095 | Universitas Amikom Yogyakarta</p>
</div>

</body>
</html>