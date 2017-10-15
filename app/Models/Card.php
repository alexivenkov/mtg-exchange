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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function eUsers()
    {
        return $this->belongsToMany(User::class, 'user_card')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function eTypes()
    {
        return $this->belongsToMany(Type::class, 'card_type')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function eSubtypes()
    {
        return $this->belongsToMany(Subtype::class, 'card_subtype')->withTimestamps();
    }
}
