<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Email extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'email';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $primaryKey = 'id';

    public $fillable = [
        'id',
        'entity_type',
        'entity_id',
        'subject',
        'message'
    ];
    /**
     * Get all of the emailRecipient for the Email
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailRecipientTo(): HasMany
    {
        return $this->hasMany('App\Models\EmailRecipient', 'email_id', 'id')
        ->where('type', "TO");
    }

    public function emailRecipientCc(): HasMany
    {
        return $this->hasMany('App\Models\EmailRecipient', 'email_id', 'id')
        ->where('type', "CC");
    }

    public function emailRecipientBcc(): HasMany
    {
        return $this->hasMany('App\Models\EmailRecipient', 'email_id', 'id')
        ->where('type', "BCC");
    }
}
