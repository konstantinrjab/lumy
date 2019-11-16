<?php

namespace App\Http\Controllers\Web;

use App\Database\Repositories\FaqRepository;
use App\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Web\FaqStoreRequest;

class FaqController extends Controller
{
    private $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::all();

        return view('faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faq.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FaqStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqStoreRequest $request)
    {
        if ($faq = $this->faqRepository->create($request->toArray())) {

            return redirect('/faqs/' . $faq->id)->with('success', 'Successfully deleted!');
        } else {

            return redirect('/faqs/')->with('error', 'Your changes wasn\'t saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = Faq::findOrFail($id);

        return view('faq.item', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);

        return view('faq.form', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FaqStoreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqStoreRequest $request, $id)
    {
        if ($this->faqRepository->update($id, $request->toArray())) {
            $message = 'Successfully deleted!';
            $status = 'success';
        } else {
            $message = 'Your changes wasn\'s saved';
            $status = 'error';
        }

        return redirect('/faqs/' . $id)->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->faqRepository->delete($id);

        return redirect('/faqs')->with('success', 'Successfully deleted!');
    }
}
