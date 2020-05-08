<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Catergories;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index(Catergories $catergories)
    {
        if($catergories->exists) {

            $threads = $catergories->threads()->latest();
    
        } else {

            $threads = Thread::latest();
        }


        //filter by username 

        if($userName = request('by')) {
            $user = \App\User::where('name', $userName)->firstOrFail();
            $threads->where('user_id', $user->id);
        }

        $threads = $threads->get();


    {
   

        return view('threads.index', compact('threads'));
    }

}


    public function create()
    {

        return view('threads.create');

    }

   
    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required',
            'body' => 'required',
            'catergories_id' => 'required|exists:catergories,id'
        ]);



        $thread = Thread::create([

            'user_id' => auth()->id(),
            'catergories_id' => request('catergories_id'),
            'title' => request('title'),
            'body'  => request('body')
        ]);

        return redirect($thread->path());
    }

 
    public function show($catergoriesId ,Thread $thread)
    {
        return view('threads.show', [
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(5)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update($catergoriesId ,Thread $thread)
    {
        
        //authorization 
        $this->authorize('update', $thread);

        //validation 
         $thread->update(request()->validate([

            'title' => 'required',
            'body' => 'required'

        ]));

        return $thread;
        // update the thread 

    






    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function delete($catergoriesId, Thread $thread)
    {  
        if( $thread->user_id != auth()->id()) {
           abort(403, 'You do not have Permission');
        }

   
        $thread->delete();

        if (request()->wantsJson()){
            return response([], 200);
        }

        return redirect('/threads');
    }
}
