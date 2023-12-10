<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surat';
    protected $fillable = [
        'uuid',
        'uuid_antrian',
        'uuid_user',
        'jenis',
        'nomor',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'nomor_ktp_kk',
        'alamat',
        'tujuan',
        'periode',
        'uraian',
        'tanggal_buat',
        'ttd',
    ];
}
