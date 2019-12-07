<?php

namespace App\Http\Controllers\Web;

use App\Database\Repositories\FaqRepository;
use App\Database\Models\Faq;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\FaqStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FaqController extends Controller
{
    private FaqRepository $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function index(): View
    {
        $faqs = Faq::all();

        return view('faq.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('faq.form');
    }

    public function store(FaqStoreRequest $request): RedirectResponse
    {
        if ($faq = $this->faqRepository->create($request->toArray())) {

            return redirect('/faqs/' . $faq->id)->with('success', 'Successfully deleted!');
        } else {

            return redirect('/faqs/')->with('error', 'Your changes wasn\'t saved');
        }
    }

    public function show($id): View
    {
        $faq = Faq::findOrFail($id);

        return view('faq.item', compact('faq'));
    }

    public function edit($id): View
    {
        $faq = Faq::findOrFail($id);

        return view('faq.form', compact('faq'));
    }

    public function update(FaqStoreRequest $request, $id): RedirectResponse
    {
        if ($this->faqRepository->update($id, $request->toArray())) {
            $message = 'Successfully deleted!';
            $status = 'success';
        } else {
            $message = 'Your changes wasn\'t saved';
            $status = 'error';
        }

        return redirect('/faqs/' . $id)->with($status, $message);
    }

    public function destroy($id): RedirectResponse
    {
        $this->faqRepository->delete($id);

        return redirect('/faqs')->with('success', 'Successfully deleted!');
    }
}
