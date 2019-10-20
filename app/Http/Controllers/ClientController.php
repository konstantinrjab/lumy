<?php

namespace App\Http\Controllers;

use App\Database\Repositories\ClientRepository;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return ClientResource::collection($this->clientRepository->getAllByUserId(Auth::id()));
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
        $client = $this->clientRepository->getByIdAndUserId($clientId, Auth::id());
        if (!$client) {
            throw new ModelNotFoundException;
        }

        return new ClientResource($client);
    }

    public function update(ClientStoreRequest $request, int $clientId): ClientResource
    {
        $this->clientRepository->update($clientId, $request->toArray(), Auth::id());

        return new ClientResource($this->clientRepository->getByIdAndUserId($clientId, Auth::id()));
    }

    public function destroy(int $clientId)
    {
        $this->clientRepository->delete($clientId, Auth::id());
    }
}
