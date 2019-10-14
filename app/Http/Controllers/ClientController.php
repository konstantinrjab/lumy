<?php

namespace App\Http\Controllers;

use App\Database\Models\Client;
use App\Database\Repositories\ClientRepository;
use App\Http\Requests\ClientStoreRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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

    public function store(ClientStoreRequest $request): Client
    {
        $client = new Client([
            'user_id' => Auth::id(),
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'patronymic' => $request->get('patronymic'),
            'comment' => $request->get('comment'),
        ]);

        if ($client->save()) {
            return $client;
        }

        throw new \Exception('Cannot save client');
    }

    public function show(Client $client)
    {
        return $client;
    }

    public function update(ClientStoreRequest $request, Client $client)
    {
        $client->fill($request->toArray());
        $client->save();

        return $client;
    }

    public function destroy(Client $client)
    {
        $client->delete();
    }
}
