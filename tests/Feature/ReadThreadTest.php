<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadThreadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user can browse threads
     *
     * @test
     * @return void
     */
    public function it_can_browse_threads()
    {
        $thread = create(Thread::class);
        
        $this->get(route('threads.index'))
            ->assertSee($thread->title);
    }

    /**
     * Test user can browse specific thread
     *
     * @test
     * @return void
     */
    public function a_user_can_browse_specific_thread()
    {
        $thread = create(Thread::class);
        
        $this->get($thread->path())
            ->assertSee($thread->title);
    }

    /**
     * Test user can filter threads according to channel
     *
     * @test
     * @return void
     */
    public function a_user_can_filter_threads_according_to_channel()
    {
        $channel = create(Channel::class);
        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadNotInChannel = create(Thread::class);

        $this->get(route('threads.channel', $channel->slug))
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }
}
