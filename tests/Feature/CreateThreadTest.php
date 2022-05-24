<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test an authenticated user create thread
     *
     * @test
     * @return void
     */
    public function an_authentcatited_user_create_thread()
    {
        $this->singIn();

        $this->get(route('threads.create'))
            ->assertSee('Create New Thread')
            ->assertSee('Title');

        $thread = make(Thread::class);

        $this->post(route('threads.store'), $thread->toArray())
            ->assertSessionHas('success_message'); //TODO redirection assert
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

        $this->get(route('threads.create'))
            ->assertRedirect(route('login'));

        $this->post(route('threads.store'), $thread->toArray())
            ->assertRedirect(route('login'));
    }

    /**
     * Test a thread require a title
     *
     * @test
     * @return void
     */
    public function a_thread_require_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors(['title']);
    }

    /**
     * Test a thread require a valid channel
     *
     * @test
     * @return void
     */
    public function a_thread_require_a_valid_channel()
    {
        create(Channel::class);

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors(['channel_id']);

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors(['channel_id']);
    }

    /**
     * Test a thread require a body
     *
     * @test
     * @return void
     */
    public function a_thread_require_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors(['body']);
    }

    private function publishThread($overrides = [])
    {
        $this->singIn();

        $thread = make(Thread::class, $overrides);

        return $this->post(route('threads.store'), $thread->toArray());
    }
}
