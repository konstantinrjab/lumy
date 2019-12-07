<?php

namespace App\Http\Controllers\Api;

use App\Database\Repositories\FaqRepository;
use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FaqController extends Controller
{
    private FaqRepository $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return FaqResource::collection($this->faqRepository->getAll());
    }
}
