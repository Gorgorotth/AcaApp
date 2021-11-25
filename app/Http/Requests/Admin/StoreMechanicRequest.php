<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMechanicRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:20'],
            'email' => ['required', Rule::unique('mechanics','email')],
            'password' => ['required', 'min:7', 'confirmed'],
            'password_confirmation' => ['required', 'min:7', 'same:password']
        ];
    }
}
