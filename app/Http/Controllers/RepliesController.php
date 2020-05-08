<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;


class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($catergoryId, Thread $thread)
    {   
        $this->validate(request(), ['body' => 'required']);
        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return back();
    }

    
    public function delete(Reply $reply)
    {

       $this->authorize('update' , $reply);

        $reply->delete();

        return back();

    }






}
