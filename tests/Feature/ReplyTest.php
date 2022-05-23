<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
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
        $reply = create(Reply::class);

        $this->get(route('threads.show', $reply->thread))
            ->assertSee($reply->body);
    }

    /**
     * Test an authentcaited user reply in thread
     *
     * @test
     * @return void
     */
    public function an_authentcatited_user_can_reply_in_thread()
    {
        $this->singIn();

        $thread = create(Thread::class);

        $reply = make(Reply::class);

        $this->post(route('replies.store', ['thread' => $thread]), $reply->toArray())
            ->assertSessionHas('success_message')
            ->assertRedirect(route('threads.show', $thread));

        $this->assertCount(1, $thread->replies);
    }

    /**
     * Test guest can't reply in thread
     *
     * @test
     * @return void
     */
    public function a_guest_can_not_reply_in_thread()
    {
        $thread = create(Thread::class);

        $this->post(route('replies.store', ['thread' => $thread]))
            ->assertRedirect(route('login'));
    }
}
