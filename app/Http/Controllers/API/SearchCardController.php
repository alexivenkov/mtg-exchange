<?php namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Requests\SearchCardRequest;
use App\Services\API\DeckbrewGateway;

class SearchCardController extends Controller
{
    public function search(SearchCardRequest $request, DeckbrewGateway $gateway)
    {

        $result = $gateway->searchCard($request->all());

        return response()->json(['a' => 1]);
    }
}