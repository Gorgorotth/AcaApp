<?php

namespace App\Http\Requests\Admin;

use App\Models\Mechanic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGarageRequest extends FormRequest
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
        return array_merge([
            'name' => ['required', 'min:3', 'max:20'],
            'address' => ['required'],
            'hourlyPrice' => ['required', 'numeric', 'min:1'],
        ],
            $this->checkEmails(),
            $this->checkMechanics(),
        );
    }

    public function checkEmails()
    {
        foreach ($this->request->get('addEmailToGarage') as $i => $email) {
            return [
                'addEmailToGarage.' . $i => [
                    'required',
                    'email',
                    Rule::unique('garage_emails', 'email'),
                ]
            ];
        }
        return [];
    }

    public function checkMechanics()
    {
        if ($mechanics = $this->request->get('mechanics')) {
            foreach ($mechanics as $i => $mechanic) {
                return [
                    'mechanics.' . $i => [
                        'required'
                    ]
                ];
            }
        }else
        return [];
    }

    public function messages()
    {
        return [
            'addEmailToGarage.*.unique' => 'One of emails already exist! Check your emails',
            'addEmailToGarage.*.email' => 'One of emails is not email type!!! Check your emails, and enter a valid email',
            'name.required' => 'Garage name must be entered!',
            'address.required' => 'Garage address must be entered'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'addEmailToGarage' => $this->addEmailToGarage ?? [],
            'mechanics' => $this->prepareMechanics(),
        ]);
    }

    public function prepareMechanics()
    {
        $mechanics = $this->request->get('addMechanicToGarage');

        if (!$mechanics) {
            return [];
        }

        foreach ($mechanics as $i => $mechanicId) {
            $allow = Mechanic::query()
                ->whereNull('garage_id')
                ->where('id', $mechanicId)
                ->first();

            if (!$allow) {
                unset($mechanics[$i]);
            }
        }
        return $mechanics;
    }
}
