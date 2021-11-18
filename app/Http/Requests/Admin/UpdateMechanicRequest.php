<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMechanicRequest extends FormRequest
{
    /**
     *
     */
    public function prepareForValidation()
    {
        $this->merge([
            'garageId' => $this->prepareGarage(),
        ]);
    }

    /**
     * @return bool|float|int|string|\Symfony\Component\HttpFoundation\InputBag|null
     */
    public function prepareGarage()
    {
        $garageId = $this->request->get('garageId');
        if ($garageId != -1) {
            return $garageId;
        }
        return null;

    }

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
        return array_merge([
                'name' => ['required', 'min:3', 'max:20'],
                'email' => ['required', 'email', Rule::unique('mechanics', 'email')->ignore(request()->mechanic)],
                'garageId' => ['nullable', Rule::exists('garages', 'id')]
            ]
        );
    }
}
