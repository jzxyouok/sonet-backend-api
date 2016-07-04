<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserConversationMapping extends Model
{
    protected $table = 'UserConversationMapping';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'conversation_id',
    ];


    public function users()
    {
    	return $this->belongsTo('App\User');
    
    }

    public function conversations()
    {
        return $this->belongsTo('App\Conversation');
    }

}
