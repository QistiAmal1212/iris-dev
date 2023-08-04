<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailRecipient extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'email_recipient';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $primaryKey = 'id';

    public $fillable = [
        'id',
        'email_id',
        'type',
        'email'
    ];

    /**
     * Get the mainEmail that owns the EmailRecipient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mainEmail(): BelongsTo
    {
        return $this->belongsTo('App/Models/Email', 'email_id');
    }

}
