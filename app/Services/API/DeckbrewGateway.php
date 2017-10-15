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
        'blue'  => 'U',
        'black' => 'B',
        'white' => 'W',
        'red'   => 'R',
        'green' => 'G'
    ];

    public function searchCard($params) : array
    {
        $response = $this->request('cards', ['query' => ['name' => $params['q']]]);
        $cardData = $response[0];
        $cardEditions = $cardData['editions'][0];

        $color = count($cardData['colors']) === 0 ? null : $cardData['colors'];
        $color = $color && count($color) > 1 ? 'M' : self::COLORS_MAP[array_shift($color)];

        return [
            'name'        => $cardData['name'],
            'cmc'         => $cardData['cmc'],
            'cost'        => $cardData['cost'],
            'description' => $cardData['text'],
            'power'       => $cardData['power'] ? $cardData['power'] : null,
            'toughness'   => $cardData['toughness'] ? $cardData['toughness'] : null,
            'types'        => $cardData['types'],
            'subtypes'    => $cardData['subtypes'],
            'set'         => $cardEditions['set'],
            'set_id'      => $cardEditions['set_id'],
            'rarity'      => self::RARITY_MAP[$cardEditions['rarity']],
            'flavor'      => $cardEditions['flavor'],
            'image'       => $cardEditions['image_url'],
            'artist'      => $cardEditions['artist'],
            'color'       => $color,
            'deckbrew_id' => $cardData['id']
        ];
    }
}
