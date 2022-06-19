<?php

namespace Tests\Feature;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a user has profile
     *
     * @test
     * @return void
     */
    public function a_user_has_profile()
    {
        $user = create(User::class);

        $this->withoutExceptionHandling()
            ->get(route('profiles.show', $user->username))
            ->assertSee($user->name);
    }

    /**
     * Test a profile display all threads for a user
     *
     * @test
     * @return void
     */
    public function a_profile_display_threads_assosited_to_the_user()
    {
        $user = create(User::class);

        $thread = create(Thread::class, ['user_id' => $user->id]);

        $this->withoutExceptionHandling()
            ->get(route('profiles.show', $user->username))
            ->assertSee($thread->title);
    }
}
