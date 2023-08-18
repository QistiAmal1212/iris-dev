<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityMenu extends Model
{
    protected $table = 'security_menu';

    protected $fillable = [
    	'name',
        'type',
        'module_id',
        'level',
        'sequence',
        'menu_link',
    ];

    public function module()
    {
        return $this->belongsTo('App\Models\Master\MasterModule', 'module_id', 'id');
    }

    public function role()
    {
        return $this->belongsToMany('App\Models\Role', 'role_has_menu', 'menu_id', 'role_id')
        ->withPivot('access', 'search', 'add', 'update', 'delete', 'report');
    }
}
