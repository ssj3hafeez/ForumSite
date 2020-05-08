<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ChannelTest extends TestCase
{
         use DatabaseMigrations;

    public function channel_has_threads()
    {

        $catergories = create('App\Catergories');
        $thread = create('App\Thread', ['catergories_id' => $catergories->id]);

        $this->assertTrue($catergories->threads->contains($thread));



    }




}