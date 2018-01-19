<?php namespace App\Services;


use App\Models\Card;
use App\Models\Set;
use App\Models\Type;
use Illuminate\Support\Collection;

class CardService
{
    const CARD_FIELDS = [
        'name',
        'cmc',
        'mana_cost',
        'description',
        'power',
        'toughness',
        'set_id',
        'rarity',
        'flavor',
        'image',
        'artist',
        'color'
    ];

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
        'green'     => 'G'
    ];

    public function store(array $cardData): Card
    {
        $this->storeSet($cardData);
        $types = $this->storeType($cardData);

    }

    /**
     * @param array $cardData
     */
    protected function storeSet(array $cardData)
    {
        $set = Set::firstOrCreate(['name' => $cardData['set_name']]);
    }

    protected function storeType(array $cardData): Collection
    {
        $types = array_first(explode('-', $cardData['type_line']));
        $types = explode(' ', $types);

        $result = collect();

        foreach ($types as $type) {
            $result->push(Type::firstOrCreate(['name' => $type]));
        }

        return $result;
    }
}
