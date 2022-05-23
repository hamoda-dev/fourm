<?php

namespace Tests\Unit;

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
    public function it_has_owner(): void
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(User::class, $thread->owner);
    }
}
