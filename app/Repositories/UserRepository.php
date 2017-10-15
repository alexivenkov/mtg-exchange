<?php namespace App\Repositories;

use App\Models\Card;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function storeCardViaAPI(Card $card, $count = 1)
    {
        $user = Auth::guard('api')->user();

        $user->eCards()->syncWithoutDetaching([$card->id => ['count' => $count]]);
    }
}