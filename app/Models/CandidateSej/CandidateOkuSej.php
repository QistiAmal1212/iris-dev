<?php

namespace App\Models\CandidateSej;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CandidateOkuSej extends Model
{
    protected $table = 'calon_oku_sej';

    protected $fillable = [
    	'no_pengenalan',
        'no_daftar_jkm',
        'status_oku',
        'kategori_oku',
        'sub_oku',
        'created_by',
        'updated_by',
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Models\Reference\KodPelbagai', 'category', 'kod');
    }
}
