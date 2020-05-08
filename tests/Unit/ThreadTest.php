<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    /** @test */

    function thread_path()
    {
        $thread = factory('App\Thread')->create();

        $this->assertEquals(
            "/threads/{$thread->catergories->slug}/{$thread->id}", $thread->path()
        );

    }

    function thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    function thread_has_replies()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->thread->replies
        );
    }

    /** @test */
    

    /** @test */
    public function thread_can_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);

    }


    function thread_belongs_to_a_channel()
    {

        $thread = factory('App\Catergories')->create();

        $this->assertInstanceOf('App\Catergories', $thread->catergories);


    }




}