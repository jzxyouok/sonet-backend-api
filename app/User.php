<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $table = 'user';
    protected $primaryKey ='id';

    public function messages()
    {
        return $this-hasMany('App\Message');
    }

    public function userConversationMapping()
    {
        return $this-hasMany('App\UserConversationMapping');
    }
}
