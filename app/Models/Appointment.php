<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'nama_siswa', 'kelas', 'kontak', 'tanggal', 'jam', 
        'jenis', 'status', 'keluhan', 'school_id'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}