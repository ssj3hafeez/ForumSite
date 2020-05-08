<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesTest extends TestCase
{


    use DatabaseMigrations;
  
    
     function user_profile()
     {

      $user = create('App\User');
      $this->get("/profiles/{$user->name}")
        ->assertSee($user->name);

     }
     

     function display_threads_by_associated_users()

     {

        $user = create('App\User');

        $thread = create('App\Thread', ['user_id' => $user->id]);
        $this->get("/profiles/{$user->name}")
            ->assertSee($thread->title)
            ->assertSee($thread->body);




     }


}
