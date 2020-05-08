<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{

   use DatabaseMigrations;

   public function guests_cannot_create_thread()
   {
    
      $this->withoutExceptionHandling();

      $this->get('threads/create')
      ->assertRedirect('/login');

     $this->post('threads')
      ->assertRedirect('/login');

   }


   public function signedin_user_can_create_thread()

   {
      $this->withoutExceptionHandling();

      $thread = factory('App\Thread')->create();

      $response= $this->post('/threads', $thread->toArray());

      $this->get($response->headers->get('Location'))
         ->assertSee($thread->title)
         ->assertSee($thread->body);
   
   }


      function validation_thread_requires_title()
      {

       $this->publishThread(['title' => null])
       ->assertSessionHasErrors('title');


      }

      function thread_requires_title_and_body_for_update()
      {

         $this->withExceptionHandling();

         $this->signIn();

         $thread = create('App\Thread', ['user_id' => auth()->id()]);

         $this->patch($thread->path(), [

            'title' => 'Changed'
         ])->assertSessionErrors('body');


         $this->patch($thread->path(), [

            'body' => 'Changed'
         ])->assertSessionErrors('title');

      }

      function unauthorized_users_cannot_update()
      {
         $this->withExceptionHandling();

         $this->signIn();

         $thread = create('App\Thread', ['user_id' => create('App\User')->id]);

         $this->patch($thread->path(),[
            'title' => 'Changed',
         ])->assertStatus(403);


      }


      function thread_can_be_updated_by_creator()
      {

         $this->signIn();

         $thread = create('App\Thread', ['user_id' => auth()->id()]);

         $this->patch($thread->path(),[
            'title' => 'Changed',
            'body' => 'Changed body'

         ]);

         $thread = $thread->fresh();

         $this->assertEquals('Changed', $thread->title);

         $this->assertEquals('Changed body', $thread->body);
 


      }


      function validation_thread_requires_body()
      {

       $this->publishThread(['body' => null])
       ->assertSessionHasErrors('body');

      }



      function validation_thread_requires_catergory()
      {

       $this->publishThread(['catergories_id' => null])
       ->assertSessionHasErrors('catergories_id');


      }


      function guest_unable_to_delete()

      {
         $this->withExceptionHandling();

         $thread = create('App\Thread');

         $this->delete($thread->path())->assertRedirect('/login');

         $this->signIn();
         $this->delete($thread->path())->assertStatus('403');


      }


      function authorized_users_can_delete_threads()
      {

         $this->signedIn();

         $thread = create('App\Thread' , ['user_id' => auth()->id()]);

         $reply = create('App\Reply', ['thread_id' => $thread->id]);

         $response =$this->json('DELETE', $thread->path());

         $response->assertStatus(200);

         $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
         $this->assertDatabaseMissing('replies', ['id' => $reply->id]);



      }

   public function publishThread($overrides = [])

   {
      $this->withExceptionHandling()->signIn();

      $thread = make('App\Thread' , $overrides);

      return $this->post('/threads' , $thread->toArray());




   }



}
