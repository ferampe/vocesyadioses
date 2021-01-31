<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    
    public function save(Request $request)
    {

        // dd($request->messages);
        DB::transaction(function () use($request){

            Auth::user()->messages()->delete();

            foreach($request->messages as $message)
            {
                // dd($message);
                $messageInstance = new Message;
                $messageInstance->user_id = Auth::user()->id;
                $messageInstance->content = $message;
                $messageInstance->save();
            }
        });
        

        return redirect('home')->with('message', 'Mensajes Actualizados');;




    }
}
