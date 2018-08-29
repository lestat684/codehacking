<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
        'photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function role() {
    	return $this->belongsTo('App\Role');
    }
    
    public function roles() {
      return $this->hasMany('App\Role', 'id');
    }

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function isAdmin() {
        if($this->role->name === 'admin' && $this->getAttribute('is_active')) {
            return true;
        }

        return false;
    }
}
