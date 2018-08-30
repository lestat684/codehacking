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

    /**
     * Relationship One to Onn for Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() {
    	return $this->belongsTo('App\Role');
    }

    /**
     *  Relationship One to Onn for Image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    /**
     * Check access for user admin with active.
     *
     * @return bool
     */
    public function isAdmin() {
        if($this->role->name === 'admin' && $this->getAttribute('is_active')) {
            return true;
        }

        return false;
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }
}
