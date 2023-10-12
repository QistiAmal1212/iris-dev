<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhliSuruhanjaya extends Model
{
    protected $table = 'ruj_ahli_suruhanjaya';

    protected $fillable = [
        'kod',
        'nama',
        'no_kp',
        'jawatan_terakhir',
        'kekananan',
        'kementerian',
        'pangkat_anugerah',
        'alamat1',
        'alamat2',
        'alamat3',
        'no_telefon',
        'nama_pasangan',
        'no_telefon_pasangan',
        'pangkat_anugerah',
        'kontrak_dari1',
        'kontrak_hingga1',
        'kontrak_dari2',
        'kontrak_hingga2',
        'kontrak_dari3',
        'kontrak_hingga3',
        'sukan1',
        'sukan2',
        'sukan3',
        'elaun_pada_gred',
        'jumlah_pendapatan',
        'tuntutan_perbatuan',
        'tuntutan_elaun_makan',
        'kelayakan_bilik_hotel',
        'minat1',
        'minat2',
        'minat3',
        'status_ahli',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
