<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test reply has thread
     *
     * @test
     * @return void
     */
    public function it_has_thread()
    {
        $reply = create(Reply::class);

        $this->assertInstanceOf(Thread::class, $reply->thread);
    }

    /**
     * Test reply has owner
     *
     * @test
     * @return void
     */
    public function it_has_owner()
    {
        $reply = create(Reply::class);

        $this->assertInstanceOf(User::class, $reply->owner);
    }
}
