<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
         use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }

    public function user_can_browse_threads()
    {

       $this->get('/threads')
       ->assertSee($this->$thread->title);


    
    }


    function user_can_read_thread()
    {

        $this->get($this->$thread->path())
         ->assertSee($this->$thread->title);

    
    }



    function user_can_read_reply_thread()
    {

     $reply = factory('App\Reply')
      ->create(['thread_id' => $this->thread->id]);

      $this->get($this->thread->path())
       ->assertSee($reply->body);
    
    }


    function user_can_filter_threads_with_catergory()
    {

        $catergories = create('App\Catergories');
        $threadInChannel = create( 'App\Thread' . ['catergories_id' => $catergories->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads' . $catergories->slug)
            ->assetSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);



    }

    function user_can_filter_threads_by_name()

    {
        $this->signIn(create('App\User', ['name' => 'hafeez']));

        $threadbyHafeez = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotbyHafeez = create('App\Thread');

        $this->get('threads?by=Hafeez')
        ->assertSee($threadbyHafeez->title)
        ->assertDontSee($threadNotbyHafeez->title);





    }


    


}
