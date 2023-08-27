<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $display_name
 * @property string $guard_name
 * @property string $created_at
 * @property string $updated_at
 * @property ModelHasRole[] $modelHasRoles
 * @property Permission[] $permissions
 */
class Role extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'display_name', 'guard_name', 'is_internal' ,'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modelHasRoles()
    {
        return $this->hasMany('App\Models\ModelHasRole');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'role_has_permissions');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_has_roles', 'role_id', 'user_id');
    }

    public function function()
    {
        return $this->belongsToMany('App\Models\Master\MasterFunction', 'role_has_function', 'role_id', 'function_id');
    }

    public function menu()
    {
        return $this->belongsToMany('App\Models\SecurityMenu', 'role_has_menu', 'role_id', 'menu_id')
        ->withPivot('access', 'search', 'add', 'update', 'delete', 'report');
    }
}
