<?php namespace App\Services\API;


class ScryfallGateway extends APIGateway
{
    const BASE_URI = 'https://api.scryfall.com/';

    public function searchCard(string $cardName): array
    {
        $searchParams = [
            'exact' => $cardName
        ];

        $response = $this->request('cards/named', $searchParams);

        dd($response);
    }
}
