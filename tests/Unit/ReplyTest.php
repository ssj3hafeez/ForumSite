<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ReplyTest extends TestCase
{


    use DatabaseMigrations;
  
    
     function user_login_can_reply()
     {

        $reply = factory('App\Reply')->create();

        $this->assertInstanceOf('App\User', $reply->owner);

     }
     
}
