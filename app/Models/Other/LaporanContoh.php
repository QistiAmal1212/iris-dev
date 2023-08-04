<?php

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DeveloperUnijaya\LaravelUploadedFile\Http\Traits\HasUploadedFile;

class LaporanContoh extends Model
{
    use HasUploadedFile;
    
    public $table = 'laporancontoh';
    protected $primaryKey = 'id';

    public $fillable = [
       'emel',191,
       'kata_laluan',191,
       'nama_projek',
       'status_projek',
       'ic_pengerusi',
       'nama_pengerusi',
       'catatan',
       'kuiri',
       'tarikh_mula_projek',
       'tarikh_akhir_projek',
    ];

    public $dates = ['tarikh_mula_projek', 'tarikh_akhir_projek'];

    // laratables addtional column: action_btn
    public static function laratablesCustomActionBtn($laporanContoh)
    {
        $btn = '';
        $btn .= '<a href="'.route('laporancontoh.viewborang', $laporanContoh->id).'" class="btn btn-xs btn-default"> <i class="fas fa-eye text-info"></i> </a>';
        $btn .=
            '<a href="#" class="btn btn-xs btn-default"
                onclick="event.preventDefault();
                Swal.fire(\'\', \'Are you sure to delete?\', \'info\').then(function(confirm) { if(confirm.value) {$(\'#formDestroyBorang_'.$laporanContoh->id.'\').trigger(\'submit\');} });"
            >
                <i class="fas fa-trash text-danger"></i>
            </a>
            <form id="formDestroyBorang_'.$laporanContoh->id.'" method="POST" action="'.route('laporancontoh.destroy', $laporanContoh->id).'">
                <input type="hidden" name="_token" value="'.csrf_token().'"/>
                <input type="hidden" name="_method" value="DELETE"/>
            </form>';
        return $btn;
    }

    public function uploadedFiles($docType = null)
    {
        return $this->hasMany(UploadedFile::class, 'borang_id','id')
        ->where('entity_type','LaporanContoh')
        ->when($docType != null, function($query) use($docType){ //if ada jenis doctype (panggil secara specifik), baru search for it. if not, cari untuk semua
            $query->where('doc_type',$docType);
        });
    }
}
