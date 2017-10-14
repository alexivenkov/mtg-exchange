<?php namespace App\Models;


class Card extends Model
{
    protected $casts = [
        'cmc'       => 'int',
        'power'     => 'int',
        'toughness' => 'int',
        'set_id'    => 'int',
    ];
}
