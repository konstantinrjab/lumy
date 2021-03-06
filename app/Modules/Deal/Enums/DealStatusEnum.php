<?php

namespace App\Modules\Deal\Enum;

use App\Common\Enums\Abstracts\Enum;

class DealStatusEnum extends Enum
{
    private const NEW = 'new';
    private const NEGOTIATIONS = 'negotiations';
    private const APPROVED = 'approved';
    private const PHOTOED = 'photoed';
    private const PROCESSED = 'processed';
    private const TRANSMITTED = 'transmitted';
    private const CLOSED = 'closed';
}
