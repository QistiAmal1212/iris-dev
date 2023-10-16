<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Mail;
use App\Mail\Auth\ResetPasswordUser;

class User extends Authenticatable
{
    //use HasApiTokens, HasFactory, Notifiable, HasRoles, LogsActivity;
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'no_ic',
        'phone_number',
        'email',
        'password',
        'ref_department_ministry_code',
        'ref_skim_code',
        'last_login',
        'last_change_password',
        'login_failed_counter',
        'is_blocked',
        'is_active',
        'time_to_change_password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty();
    // }

    public function getRolesDisplay()
    {

        $roles = auth()->user()->roles()->pluck('display_name')->toArray();
        $display = '';

        foreach($roles as $role => $text){
            $display .= $text;
            if($role !== array_key_last($roles)){
                $display .= ',';
            }
        }

        return $display;
    }

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email)->send(new ResetPasswordUser($token, $this->email));
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_has_roles', 'user_id', 'role_id');
    }

    public function department_ministry()
    {
        return $this->belongsTo('App\Models\Reference\DepartmentMinistry', 'ref_department_ministry_code', 'kod');
    }

    public function skim()
    {
        return $this->belongsTo('App\Models\Reference\Skim', 'ref_skim_code', 'kod');
    }
}
