<?php

namespace Tests\Feature;

use App\Models\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test can list replies in thread
     *
     * @test
     * @return void
     */
    public function it_can_list_replies_in_thread()
    {
        $reply = Reply::factory()->create();

        $this->get(route('threads.show', $reply->thread))
            ->assertSee($reply->body);
    }
}
