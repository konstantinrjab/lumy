<?php

namespace App\Modules\Faq\Controllers;

use App\Modules\Faq\Models\Faq;
use App\Modules\Faq\Repositories\FaqRepository;
use App\Http\Controllers\Controller;
use App\Modules\Faq\Resources\FaqResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FaqApiController extends Controller
{
    private FaqRepository $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return FaqResource::collection(Faq::all());
    }
}
