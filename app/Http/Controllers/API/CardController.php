<?php namespace App\Http\Controllers\API;

use App\Events\UserAddCard;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Set;
use App\Models\Type;
use App\Repositories\CardRepository;
use App\Repositories\SetRepository;
use App\Repositories\SubtypeRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserRepository;
use App\Requests\SearchCardRequest;
use App\Services\API\ScryfallGateway;
use Illuminate\Support\Collection;

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
     * @param ScryfallGateway   $gateway
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCard(SearchCardRequest $request, ScryfallGateway $gateway)
    {
        $card = Card::where('name', $request->input('card'))->first();

        if (!$card) {
            $result = $gateway->searchCard($request->input('card'));

            $set = $this->storeCardSet($result['set_name']);
            $cardTypes = $this->storeCardTypes($result['type_line']);


        }

        $this->userRepository->storeCardViaAPI($card, $request->get('count'));
        event(new UserAddCard($card));

        return response()->json(['name' => $card->name]);
    }

    public function index()
    {

    }

    public function show()
    {

    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    /**
     * @param string $type
     *
     * @return array
     */
    protected function getCardType(string $type): array
    {
        $type = explode('-', $type);

        return explode('-', $type[0]);
    }

    /**
     * @param string $type
     *
     * @return Collection
     */
    protected function storeCardTypes(string $type): Collection
    {
        $types = collect();

        foreach ($this->getType($type) as $type) {
            $types->push(Type::firstOrCreate(['name' => $type]));
        }

        return $types;
    }

    /**
     * @param string $set
     *
     * @return int
     */
    protected function storeCardSet(string $set): int
    {
        $set = Set::firstOrCreate(['name' => $set]);

        return $set->id;
    }
}
