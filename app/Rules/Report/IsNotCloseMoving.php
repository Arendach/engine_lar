<?php

namespace App\Rules\Report;

use App\Models\Report;
use Illuminate\Contracts\Validation\Rule;

class IsNotCloseMoving implements Rule
{
    public function passes($attribute, $value)
    {
        $report = Report::findOrFail(request('id'));

        return preg_match('~0$~', $report->data);
    }

    public function message()
    {
        return 'Ця транзакція вже закрита';
    }
}
