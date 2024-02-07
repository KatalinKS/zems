<?php

namespace App\Actions\Common;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class CalculateSpentTime
{
    public function calculate(Collection $collection, string $field): string
    {
        return Carbon::parse($collection->sum($field))->toTimeString();
    }
}

