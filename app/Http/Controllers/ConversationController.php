<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\UserConversationMapping;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ConversationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => Conversation::all()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);}
        //$target_user_id = $request->user_id;
            if($user->id==$request->user_id){
                return response()->json([
                            'error' => 'its the same user'
                        ], 409);

            }
        $conversation_ids = UserConversationMapping::whereIn('user_id',[$user->id,(int)$request->user_id])
                                                    ->pluck("conversation_id");    
        
        
        $mp = array();
        //return $conversation_ids;
        for($i=0;$i<count($conversation_ids);$i++){
            //$mp[$conversation_ids[$i]]=$conversation_ids[$i];
                

                  //If the exception is thrown, this text will not be shown
                      if(array_key_exists($conversation_ids[$i],$mp))
                    {
                        //return Conversation::find($conversation_ids[$i]);
                        return response()->json([
                            'data' => Conversation::find($conversation_ids[$i])
                        ], 200);

                    }
                    else
                    {
                        $mp[$conversation_ids[$i]]=1;   
                    }
                
        }

        $conversation = Conversation::create();
        $userConversationMapping = UserConversationMapping::create([
                                'user_id' => $user->id, 
                                'conversation_id' =>  $conversation->id,
                                //'name' => $request->name
                                ]);
        $userConversationMapping = UserConversationMapping::create([
                                'user_id' => $request->user_id, 
                                'conversation_id' =>  $conversation->id,
                                //'name' => $request->name
                                ]);
            return response()->json([
                            'data' => $conversation,

                        ], 200);
       

    }

    public function messages(Request $request,$conversation_id)
    {
         $currentUser = JWTAuth::parseToken()->authenticate();
         //$conversation_id = UserConversationMapping::find($currentUser->id)->conversation_id;
         $messages = Conversation::find($conversation_id)->messages;
         $mymessages=array();
         $theirmessages=array();
         foreach ($messages as $message) {
             # code...
            if($message->sender_id==$currentUser->id){
                array_push($mymessages,$message);
            }
            else{
                array_push($theirmessages, $message);
            }
         }
        return response()->json([
            'data' => $messages
        ], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        //$conversation_ids = UserConversationMapping::find($currentUser->user_id)->conversation_id;

        return Conversation::whereIn('id',UserConversationMapping::where('user_id', $currentUser->id)
                                        //->orderBy('created_at', 'desc')
                                        ->pluck("conversation_id"))->get();
            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Conversation::destroy($id);
    }


}