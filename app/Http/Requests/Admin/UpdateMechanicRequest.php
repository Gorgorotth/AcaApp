<?php

namespace App\Http\Requests\Admin;

use App\Models\Mechanic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMechanicRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'garage' => $this->prepareGarage(),
            'email' => $this->prepareEmail(),
        ]);
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
        return [
            'name' => ['nullable', 'min:3', 'max:20'],
            'email' => ['nullable', 'email', Rule::unique('mechanics', 'email')],
            'garage' => ['nullable', Rule::exists('garages', 'id')]
        ];
    }


    public function prepareGarage()
    {
        $mechanicId = session()->get('mechanicId');
        $garageId = $this->request->get('garage');
        if ($garageId && $garageId != -1){
            if (Mechanic::query()->where('id', $mechanicId)->where('garage_id', $garageId)->exists()){
                unset($garageId);
                return null;
            }else return $garageId;
        }else return null;

    }
    public function prepareEmail()
    {
        $mechanicId = session()->get('mechanicId');
        if ($email = $this->request->get('email')){
            if (Mechanic::query()->where('id', $mechanicId)->where('email', $email)->exists()){
                unset($email);
                return null;
            }else return $email;
        }else return null;

    }
}
