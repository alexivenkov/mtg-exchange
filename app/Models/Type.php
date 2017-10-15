<?php namespace App\Models;

class Type extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function eCards()
    {
        return $this->belongsToMany(Card::class, 'card_type');
    }
}
