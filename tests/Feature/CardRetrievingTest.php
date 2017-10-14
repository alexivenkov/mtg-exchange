<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CardRetrievingTest extends TestCase
{
    const AUTH_DRIVER = 'api';

    /**
     * @test
     */
    public function it_can_response_with_card_data()
    {
        // Когда приходит запрос с именем карты
        // Мы возвращали все данные этой карты тому кто спрашивал

        // 1. Зарос с валидным токеном из системы

        $user = factory(User::class)->create();
        $this->actingAs($user, self::AUTH_DRIVER)

            ->get('/api/v1/search?q=shapers+of+nature', [
                'Accept' => 'application/json'
            ])
            ->assertJson([
                'name' => 'Shapers of Nature'
            ]);
    }
}
