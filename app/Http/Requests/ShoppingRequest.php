<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShoppingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sum' => ['required'],
            'sum_iva' => ['required'],
            'sum_all' => ['required'],
            'comments' => ['required', 'max:191'],
            'id_bills' => ['required', ],
            'id_producto' => ['required',],
            'amount' => ['required', 'integer'],
        ];
    }
}
