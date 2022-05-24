<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadThreadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test can browse threads
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
     * Test can browse specific thread
     *
     * @test
     * @return void
     */
    public function it_can_browse_specific_thread()
    {
        $thread = create(Thread::class);
        
        $this->get($thread->path())
            ->assertSee($thread->title);
    }
}
