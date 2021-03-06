<?php

namespace App\Modules\Client\Controllers;

use App\Modules\Client\Models\Client;
use App\Modules\Client\Repositories\ClientRepository;
use App\Http\Controllers\Controller;
use App\Modules\Client\Requests\ClientStoreRequest;
use App\Modules\Client\Resources\ClientResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return ClientResource::collection($this->clientRepository->getVisibleByUserId(Auth::id()));
    }

    public function store(ClientStoreRequest $request): ClientResource
    {
        $data = $request->toArray();
        $data['user_id'] = Auth::id();
        $data['visibility'] = Client::VISIBILITY_VISIBLE;
        $client = $this->clientRepository->create($data);

        return new ClientResource($client);
    }

    public function show(int $clientId): ClientResource
    {
        $client = $this->clientRepository->getByIdAndUserIdOrFail($clientId, Auth::id());

        return new ClientResource($client);
    }

    public function update(ClientStoreRequest $request, int $clientId): ClientResource
    {
        $this->clientRepository->update($clientId, $request->toArray(), Auth::id());

        return new ClientResource($this->clientRepository->getByIdAndUserIdOrFail($clientId, Auth::id()));
    }

    public function destroy(int $clientId)
    {
        $this->clientRepository->deleteOrHide($clientId, Auth::id());
    }
}
