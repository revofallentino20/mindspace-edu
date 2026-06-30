<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'nama', 'kode', 'alamat', 'kota', 'kontak', 'email', 'jenjang', 'aktif'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}