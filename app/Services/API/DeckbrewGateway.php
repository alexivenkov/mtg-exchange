<?php namespace App\Services\API;


class DeckbrewGateway extends API
{
    const BASE_URI = 'https://api.deckbrew.com/mtg';

    public function searchCard($params)
    {
        dd($params);
    }
}
