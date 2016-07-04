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
        $conversations = Conversation::all();
        return response()->json([
            'data' => $conversations
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
  
        $conversation = Conversation::create();
        $userConversationMapping = UserConversationMapping::create([
            'user_id' => $user->id,
            'conversation_id' => $conversation->id
            ]);
        return response()->json([
            'data' => $userConversationMapping
        ], 200);

    }

    public function messages()
    {
         $currentUser = JWTAuth::parseToken()->authenticate();
         $conversation_id = UserConversationMapping::find($currentUser->id)->conversation_id;
         $messages = Conversation::find($currentUser->conversation_id)->messages;

        return response()->json([
            'data' => $messages->sortByDesc('id')->all()
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
                                        ->orderBy('created_at', 'desc')
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