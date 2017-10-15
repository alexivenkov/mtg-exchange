<?php namespace App\Repositories;


use App\Models\Subtype;
use Illuminate\Support\Collection;

class SubtypeRepository
{
    /**
     * @param Collection $subtypes
     *
     * @return Collection
     */
    public function storeSubtypes(Collection $subtypes) : Collection
    {
        $result = collect([]);

        $subtypes->each(function (string $subtype) use ($result) {
            $subtype = Subtype::firstOrCreate([
                'name' => $subtype
            ], [
                'name' => $subtype
            ]);

            $result->push($subtype);
        });

        return $result;
    }
}