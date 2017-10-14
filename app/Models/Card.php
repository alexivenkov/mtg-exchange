<?php namespace App\Models;


class Card extends Model
{
    protected $casts = [
        'cmc'       => 'int',
        'power'     => 'int',
        'toughness' => 'int',
        'set_id'    => 'int',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eTypes()
    {
        return $this->hasMany(Type::class, 'card_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eSubtypes()
    {
        return $this->hasMany(Subtype::class, 'card_id', 'id');
    }
}
