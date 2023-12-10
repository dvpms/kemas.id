<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;
    protected $table = 'warga';
    protected $fillable = [
        'uuid',
        'nama',
        'alamat',
        'nomorKK',
        'nomorKTP',
        'tempatLahir',
        'tanggalLahir',
        'jenisKelamin',
        'statusPerkawinan',
        'pekerjaan',
        'nomorTelepon',
        'email',
        'statusDiKeluarga',
        'kepalaKeluarga',
        'golonganDarah',
        'kewarganegaraan',
        'agama'
    ];
}
