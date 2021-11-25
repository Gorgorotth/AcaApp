<?php

namespace App\Http\Requests\Admin;

use App\Models\Mechanic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGarageRequest extends FormRequest
{

    /**
     *
     */
    public function prepareForValidation()
    {
        $this->merge([
            'addEmailToGarage' => $this->addEmailToGarage ?? [],
            'mechanics' => $this->prepareMechanics()
        ]);
    }

    /**
     * @return array|bool|float|int|string|\Symfony\Component\HttpFoundation\InputBag
     */
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
            'hourlyRate' => ['required', 'numeric', 'min:1'],
        ],
            $this->checkEmails(),
            $this->checkMechanics(),
        );
    }

    /**
     * @return array|array[]
     */
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

    /**
     * @return array|\string[][]|void
     */
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
        } else {
            return [];
        }
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'addEmailToGarage.*.unique' => 'One of emails already exist! Check your emails'
        ];
    }
}
