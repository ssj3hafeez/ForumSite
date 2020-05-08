<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\TestCase;

class PartcipateInForum extends TestCase
{

    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    function users_not_signed_can_reply()
    {

        $this->withExceptionHandling()
        ->post('/threads/catergories/2/replies', [])
        ->assertRedirect('login');
    }

    function authorized_user_can_reply_threads()
         {

            $this->signIn();

            $thread = factory('App\Thread')->create();
            $reply = factory('App\Reply')->make();
    
            $this->post($thread->path() . '/replies', $reply->toArray());
    
            $this->get($thread->path())
                ->assertSee($reply->body);

     }


     function reply_requires_body()

     {

        $this->withExceptionhandling()->signIn();

        $thread = factory('App\Thread')->create();
         $reply = factory('App\Reply', [ 'body' => null])->make();

         $this->post($thread->path() . 'replies' . $reply->toArray())
            ->assertSessionHasErrors('body');

     }



     function unauthorized_users_cannot_delete_reply()

     {      
            $this->withExceptionHandling();

            $reply = create('App\Reply');

            $this->delete("/replies/{$reply->id}")
            ->assertRedirect('login');

            $this->signIn()
            ->delete("replies/{$reply->id}")
            ->assertStatus(403);


     }


     function authorized_users_can_delete_replies()
    {

     $this->signIn();
     
    $reply = create('App\Reply' , ['user_id' => auth()->id()]);

     $this->delete("replies/{$reply->id}")->assertStatus(300);

     $this->assertDatabaseMissing('replies' , ['id' => $reply->id]);




    }


 }
