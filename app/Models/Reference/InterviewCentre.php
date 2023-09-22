<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class InterviewCentre extends Model
{
    protected $table = 'ruj_pusat_temuduga';

    protected $fillable = [
        'kod',
        'nama',
        'kod_ruj_kawasan_pst_td',
        'kod_ruj_negeri',
        'jenis_pusat',
        'kod_pendek',
        'order_seq',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
