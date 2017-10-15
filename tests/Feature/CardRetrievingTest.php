<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class CardRetrievingTest extends TestCase
{
    const AUTH_DRIVER = 'api';

    /**
     * @test
     */
    public function it_can_response_with_card_data()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user, self::AUTH_DRIVER)

            ->get('/api/v1/search?q=carnage+tyrant', [
                'Accept' => 'application/json'
            ])
            ->assertJson([
                'name' => 'Carnage Tyrant'
            ]);
    }
}
