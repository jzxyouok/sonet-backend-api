<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversation';
    protected $primaryKey ='id';
    public $timestamps = false;


    public function User()
    {
    	return $this-belongsTo('App/User');
    
    }

    public function Message()
    {
    	return $this-belongsTo('App/Message');
    
    }
}
