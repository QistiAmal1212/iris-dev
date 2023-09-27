<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CandidateOku extends Model
{
    protected $table = 'calon_oku';

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
