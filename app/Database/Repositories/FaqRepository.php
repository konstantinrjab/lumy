<?php

namespace App\Database\Repositories;

use App\Faq;

class FaqRepository
{
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
