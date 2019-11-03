<?php

namespace App\Database\Repositories;

use App\Faq;

class FaqRepository
{
    public function delete(int $id): int
    {
        return Faq::findOrFail($id)->delete();
    }
}
