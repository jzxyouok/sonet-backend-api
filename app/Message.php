<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey ='id';
    public $timestamps = false;

    public function User()
    {
    	return $this-belongsTo('App/User');
    
    }
    
    public function Conversation()
    {
    	return $this-belongsTo('App/Conversation');
    }
    

}
