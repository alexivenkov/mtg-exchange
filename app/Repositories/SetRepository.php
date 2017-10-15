<?php namespace App\Repositories;


use App\Models\Set;

class SetRepository
{
    /**
     * @param string $id
     * @param string $name
     *
     * @return Set
     */
    public function getSetByDeckbrewData(string $id, string $name) : Set
    {
        return Set::firstOrCreate([
            'deckbrew_id' => $id
        ], [
            'name'        => $name,
            'deckbrew_id' => $id
        ]);
    }
}
