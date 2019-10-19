<?php

namespace App\Entities\Enum;

class ExpenseTypeEnum extends Enum
{
    private const AMORTIZABLE = 'amortizable';
    private const REPETITIVE = 'repetitive';
    private const SINGLE_TIME = 'singleTime';
}
