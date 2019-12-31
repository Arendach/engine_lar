<?php

namespace App\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryAddressRequest extends FormRequest
{
/*    public function validate(Request $request): void
    {
        if ($request->isEmpty('city'))
            $this->error('city', 'Введіть назву міста!');

    }*/

    public function authorize(): bool
    {
        return true;
    }
}