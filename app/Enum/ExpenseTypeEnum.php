<?php

namespace App\Enum;

use App\Entities\Enum\Abstracts\Enum;

class ExpenseTypeEnum extends Enum
{
    private const AMORTIZABLE = 'amortizable';
    private const REPETITIVE = 'repetitive';
    private const SINGLE_TIME = 'singleTime';
}
