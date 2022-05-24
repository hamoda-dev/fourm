<?php

namespace Tests\Unit;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test thread has owner
     *
     * @test
     * @return void
     */
    public function a_thread_has_owner(): void
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(User::class, $thread->owner);
    }

    /**
     * Test thread belongs to channel
     *
     * @test
     * @return void
     */
    public function a_thread_belongs_to_channel()
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(Channel::class, $thread->channel);
    }
}
