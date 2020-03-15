<?php

namespace App\Modules\Expense\Enum;

use App\Common\Enums\Abstracts\Enum;

class ExpenseTypeEnum extends Enum
{
    private const AMORTIZABLE = 'amortizable';
    private const REPETITIVE = 'repetitive';
    private const SINGLE_TIME = 'singleTime';
}
