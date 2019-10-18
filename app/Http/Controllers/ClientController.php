<?php

namespace App\Http\Controllers;

use App\Database\Repositories\ClientRepository;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        return $this->clientRepository->getByUserId(Auth::id());
    }

    public function store(ClientStoreRequest $request): ClientResource
    {
        $data = [
            'user_id'    => Auth::id(),
            'name'       => $request->get('name'),
            'surname'    => $request->get('surname'),
            'patronymic' => $request->get('patronymic'),
            'comment'    => $request->get('comment'),
            'emails'    => $request->get('emails'),
            'phones'    => $request->get('phones'),
        ];
        $client = $this->clientRepository->create($data);

        return new ClientResource($client);
    }

    public function show(int $clientId): ClientResource
    {
        return new ClientResource($this->clientRepository->get($clientId));
    }

    public function update(ClientStoreRequest $request, int $clientId): ClientResource
    {
        $this->clientRepository->update($clientId, $request->toArray());

        return new ClientResource($this->clientRepository->get($clientId));
    }

    public function destroy(int $clientId)
    {
        $this->clientRepository->delete($clientId);
    }
}
