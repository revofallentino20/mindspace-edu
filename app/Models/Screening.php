<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    protected $fillable = [
        'kelas', 'school_id',
        'skor_stres', 'skor_cemas', 'skor_depresi', 'status', 'catatan',
        'phq1','phq2','phq3','phq4','phq5','phq6','phq7','phq8','phq9','skor_phq',
        'gad1','gad2','gad3','gad4','gad5','gad6','gad7','skor_gad',
        'kategori_phq','kategori_gad'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}