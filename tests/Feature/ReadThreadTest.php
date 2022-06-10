<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
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

    /**
     * Test user can filter threads by any username
     *
     * @test
     * @return void
     */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->singIn(create(User::class, ['name' => 'JoneDoe']));
        $threadByJone = create(Thread::class, ['user_id' => auth()->id()]);
        $threadNotByJone = create(Thread::class);

        $this->get(route('threads.index') . '?by=' . auth()->user()->name)
            ->assertSee($threadByJone->title)
            ->assertDontSee($threadNotByJone->title); 
    }

    /**
     * Test use can filter threads by popularity
     *
     * @test
     * @return void
     */
    public function a_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReply = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithTwoReply->id], 2);

        $threadWithThreeReply = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithThreeReply->id], 3);

        $threadWithOutReply = create(Thread::class);

        $respones = $this->getJson(route('threads.index') . '?popular=1')->json();

        $this->assertEquals([3, 2, 0, 0, 0, 0, 0, 0], array_column($respones, 'replies_count'));
    }
}
