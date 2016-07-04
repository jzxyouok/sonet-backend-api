<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversation';
    protected $primaryKey ='id';
    public $timestamps = false;

    protected $fillable = [
        'user1_id', 'user2_id',
    ];


    public function User()
    {
    	return $this->belongsTo('App\User');
    
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function userConversationMapping()
    {
        return $this->hasMany('App\UserConversationMapping');
    }
}


