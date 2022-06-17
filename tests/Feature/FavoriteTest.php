<?php

namespace Tests\Feature;

use App\Models\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a guest can't favorite a reply
     *
     * @test
     * @return void
     */
    public function a_guest_can_not_favorite_a_reply()
    {
        $this->post(route('favorites.reply', 1))
            ->assertRedirect(route('login'));
    }

    /**
     * Test an authentcatited user can favorite reply
     *
     * @test
     * @return void
     */
    public function authentcatited_user_can_favorite_reply()
    {
        $this->singIn();

        $reply = create(Reply::class);

        $this->post(route('favorites.reply', $reply));

        $this->assertCount(1, $reply->favorites);
    }

    /**
     * Test an authentcatited user can favorite reply only one time
     *
     * @test
     * @return void
     */
    public function an_authentcatied_user_can_favorite_reply_only_one_time()
    {
        $this->singIn();

        $reply = create(Reply::class);

        try {
            $this->post(route('favorites.reply', $reply));
            $this->post(route('favorites.reply', $reply));
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert the same record set twice.');
        }

        $this->assertCount(1, $reply->favorites);
    }
}
