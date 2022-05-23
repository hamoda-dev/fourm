<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadTest extends TestCase
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
        
        $this->get(route('threads.show', $thread))
            ->assertSee($thread->title);
    }

    /**
     * Test an authenticated user create thread
     *
     * @test
     * @return void
     */
    public function an_authentcatited_user_create_thread()
    {
        $this->singIn();

        $thread = make(Thread::class);

        $this->post(route('threads.store'), $thread->toArray())
            ->assertSessionHas('success_message');
    }

    /**
     * Test an authenticated user create thread
     *
     * @test
     * @return void
     */
    public function a_guest_can_not_create_thread()
    {
        $thread = make(Thread::class);

        $this->post(route('threads.store'), $thread->toArray())
            ->assertRedirect(route('login'));
    }
}
