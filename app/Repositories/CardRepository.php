<?php namespace App\Repositories;

use App\Models\Card;
use Illuminate\Support\Collection;

class CardRepository
{
    /**4
     * @param Card       $card
     * @param Collection $types
     */
    public function storeCardTypes(Card $card, Collection $types): void
    {
        $card->eTypes()->sync($types->pluck('id'));
    }

    public function storeCardSubtypes(Card $card, Collection $subtypes): void
    {
        $card->eSubtypes()->sync($subtypes->pluck('id'));
    }
}