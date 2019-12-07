<?php

namespace App\Database\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Database\Models\Faq;

class FaqRepository
{
    public function getAll(): Collection
    {
        return Faq::all();
    }

    public function create(array $data): ?Faq
    {
        $faq = new Faq();

        $faq->alias = $data['alias'];
        $faq->title = $data['title'];
        $faq->text = $data['text'];

        if ($faq->save()) {
            return $faq;
        }

        return null;
    }

    public function update(int $faqId, array $data): bool
    {
        $faq = Faq::findOrFail($faqId);

        $faq->alias = $data['alias'];
        $faq->title = $data['title'];
        $faq->text = $data['text'];

        return $faq->save();
    }

    public function delete(int $id): int
    {
        return Faq::findOrFail($id)->delete();
    }
}
