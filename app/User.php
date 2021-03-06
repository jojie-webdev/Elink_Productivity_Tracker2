<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'department',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
        $role = Role::with('rolecat')->get();

        foreach($role as $roles){
          echo  $roles->role_id->name;
        }
    }

    public function isAdmin() {

        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'supervisor')
            {
                return true;
            }
        }
    }

    public function latestUser()
    {
        return $this->hasMany('\App\User')->latest();
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function lists()
    {
        return $this->hasMany('App\ActivityList');
    }

    public function getListCountAttribute(){
        return $this->lists()->count();
    }
}
