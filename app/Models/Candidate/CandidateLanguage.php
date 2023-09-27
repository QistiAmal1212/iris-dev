<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateLanguage extends Model
{
    protected $table = 'calon_bahasa';

    protected $fillable = [
    	'no_pengenalan',
        'jenis_bahasa',
        'penguasaan',
        'created_by',
        'updated_by',
    ];

    public function language() {
        return $this->belongsTo('App\Models\Reference\Language', 'jenis_bahasa', 'kod');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Models\Reference\KodPelbagai', 'penguasaan', 'kod')->where('kategori', 'PENGUASAAN BAHASA');
    }
}
