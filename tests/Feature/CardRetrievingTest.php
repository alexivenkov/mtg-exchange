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
        $cards = [
            'Carnage Tyrant',
            'Shapers of Nature',
            'Prying Blade',
            'New Horizons'
        ];

        $this->actingAs($user, self::AUTH_DRIVER);

        foreach ($cards as $card) {
            $this->get("/api/v1/add?q=$card", [
                'Accept' => 'application/json'
            ])
                ->assertJson([
                    'name' => "$card"
                ]);
        }
    }
}
