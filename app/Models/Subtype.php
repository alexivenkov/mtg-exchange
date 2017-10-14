<?php namespace App\Models;


class Subtype extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eCards()
    {
        return $this->hasMany(Card::class, 'subtype_id', 'id');
    }
}