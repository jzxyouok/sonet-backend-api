<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vinkla\Pusher\Facades\Pusher;
use App\Http\Requests;

class callController extends Controller
{
    public function sendCallRequest(Request $request)
    {	
    	Pusher::trigger('call.'.$request->conversation_id, 'call-event', 
    		array('destination_id' => $request->destination_id,
    				'sender_id' => $request->this_user_id
    				));

    }

    public function acceptCallRequest(Request $request)
    {	
    	Pusher::trigger('callAnswer.'.$request->conversation_id, 'call-answer-event', 
    		array('destination_id' => $request->destination_id,
    				'sender_id' => $request->this_user_id
    				));

    }
}
