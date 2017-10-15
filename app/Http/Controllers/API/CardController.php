<?php namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Repositories\CardRepository;
use App\Repositories\SetRepository;
use App\Repositories\SubtypeRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserRepository;
use App\Requests\SearchCardRequest;
use App\Services\API\DeckbrewGateway;

class CardController extends Controller
{
    protected $userRepository;

    protected $cardRepository;

    protected $setRepository;

    protected $typeRepository;

    protected $subTypeRepository;

    public function __construct(
        UserRepository $userRepository,
        CardRepository $cardRepository,
        SetRepository $setRepository,
        TypeRepository $typeRepository,
        SubtypeRepository $subtypeRepository
    ) {
        $this->userRepository = $userRepository;
        $this->cardRepository = $cardRepository;
        $this->setRepository = $setRepository;
        $this->typeRepository = $typeRepository;
        $this->subTypeRepository = $subtypeRepository;
    }

    /**
     * @param SearchCardRequest $request
     * @param DeckbrewGateway   $gateway
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCard(SearchCardRequest $request, DeckbrewGateway $gateway)
    {
        $card = Card::where('name', $request->get('q'))->first();

        if (!$card) {
            $result = $gateway->searchCard($request->all());

            $set = $this->setRepository->getSetByDeckbrewData($result['set_id'], $result['set']);
            $result['set_id'] = $set->id;

            $types = $this->typeRepository->storeTypes(collect($result['types']));
            $subtypes = $this->subTypeRepository->storeSubtypes(collect($result['subtypes']));

            $card = Card::create(array_except($result, ['set', 'types', 'subtypes']));
            $this->cardRepository->storeCardTypes($card, $types);
            $this->cardRepository->storeCardSubtypes($card, $subtypes);
        }

        $this->userRepository->storeCardViaAPI($card, $request->get('count'));

        return response()->json(['name' => $card->name]);
    }
}
