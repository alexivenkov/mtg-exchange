<?php namespace App\Repositories;

use App\Models\Type;
use Illuminate\Support\Collection;

class TypeRepository
{
    /**
     * @param Collection $types
     *
     * @return Collection
     */
    public function storeTypes(Collection $types): Collection
    {
        $result = collect([]);

        $types->each(function (string $type) use ($result) {
            $type = Type::firstOrCreate([
                'name' => $type
            ], [
                'name' => $type
            ]);

            $result->push($type);
        });

        return $result;
    }
}
