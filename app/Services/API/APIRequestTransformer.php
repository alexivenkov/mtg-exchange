<?php namespace App\Services\API;


class APIRequestTransformer
{
    const CARD_TRANSFORM_FIELDS = [
        'description',
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
        'blue'  => 'U',
        'black' => 'B',
        'white' => 'W',
        'red'   => 'R',
        'green' => 'G'
    ];

    /**
     * @param array $cardData
     *
     * @return array
     */
    public function transform(array $cardData): array
    {
        foreach (self::CARD_TRANSFORM_FIELDS as $filed) {
            $cardData = $this->{'transform' . studly_case($filed)}($cardData);
        }

        return $cardData;
    }

    /**
     * @param array $cardData
     *
     * @return array
     */
    protected function transformDescription(array $cardData): array
    {
        $cardData['description'] = $cardData['oracle_text'];

        return $cardData;
    }

    /**
     * @param array $cardData
     *
     * @return array
     */
    protected function transformRarity(array $cardData): array
    {
        $cardData['rarity'] = self::RARITY_MAP[$cardData['rarity']];

        return $cardData;
    }

    /**
     * @param array $cardData
     *
     * @return array
     */
    protected function transformFlavor(array $cardData): array
    {
        $cardData['flavor'] = $cardData['flavor_text'];

        return $cardData;
    }

    /**
     * @param array $cardData
     *
     * @return array
     */
    protected function transformImage(array $cardData): array
    {
        $cardData['image'] = $cardData['image_uris']['normal'];

        return $cardData;
    }

    /**
     * @param array $cardData
     *
     * @return array
     */
    protected function transformColor(array $cardData): array
    {
        $cardData['color'] = $cardData['colors'] ?: null;

        return $cardData;
    }
}
