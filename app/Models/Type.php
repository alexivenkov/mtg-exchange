<?php namespace App\Models;

class Type extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eCards()
    {
        return $this->hasMany(Card::class, 'type_id', 'id');
    }
}
