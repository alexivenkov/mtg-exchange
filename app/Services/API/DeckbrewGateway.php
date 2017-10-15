<?php namespace App\Services\API;


class DeckbrewGateway extends API
{
    const BASE_URI = 'https://api.deckbrew.com/mtg/';

    const RARITY_MAP = [
        'common'   => '*',
        'uncommon' => '**',
        'rare'     => '***',
        'mythic'   => '****'
    ];

    const COLORS_MAP = [
        'blue'      => 'U',
        'black'     => 'B',
        'white'     => 'W',
        'red'       => 'R',
        'green'     => 'G',
        'colorless' => null
    ];

    public function searchCard($params): array
    {
        $response = $this->request('cards', ['query' => ['name' => $params['q']]]);
        $cardData = $response[0];
        $cardEditions = $cardData['editions'][0];

        $color = array_get($cardData, 'colors', ['colorless']);
        $color = $color && count($color) > 1 ? 'M' : self::COLORS_MAP[array_shift($color)];

        return [
            'name'        => $cardData['name'],
            'cmc'         => $cardData['cmc'],
            'cost'        => $cardData['cost'],
            'description' => $cardData['text'],
            'power'       => array_get($cardData, 'power'),
            'toughness'   => array_get($cardData, 'toughness'),
            'types'       => $cardData['types'],
            'subtypes'    => array_get($cardData, 'subtypes'),
            'set'         => $cardEditions['set'],
            'set_id'      => $cardEditions['set_id'],
            'rarity'      => self::RARITY_MAP[$cardEditions['rarity']],
            'flavor'      => array_get($cardEditions, 'flavor'),
            'image'       => $cardEditions['image_url'],
            'artist'      => $cardEditions['artist'],
            'color'       => $color,
            'deckbrew_id' => $cardData['id']
        ];
    }
}
