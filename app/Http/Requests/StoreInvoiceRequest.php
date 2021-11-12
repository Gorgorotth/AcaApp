<?php

namespace App\Http\Requests;

use App\Models\InvoicePart;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'addPartName' => $this->addPartName ?? [],
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'inputVin' => ['required'],
            'inputPlate' => ['required'],
            'inputBrand' => ['required'],
            'inputModel' => ['required'],
            'inputClientName' => ['required'],
            'inputClientLastName' => ['required'],
        ],
            $this->checkInvoicePartsInputs()
            ,$this->checkClientInputs()
        );

    }

    /**
     * @return array|\string[][]
     */
    public function checkInvoicePartsInputs()
    {
        foreach ($this->request->get('addPartName') as $i => $part) {
            if ($this->request->get('addPartType')[$i] == InvoicePart::JOB_TYPE_PART){
                $addPartStockNo = ['addPartStockNo.' . $i => ['required']];
                $addPartPrice = ['addPartPrice.' . $i => ['required']];
            } elseif ($this->request->get('addPartType')[$i] == InvoicePart::JOB_TYPE_LIQUID){
                $addPartStockNo = [];
                $addPartPrice = ['addPartPrice.' . $i => ['required']];
            } else {
                $addPartStockNo = [];
                $addPartPrice = [];
            }
            return array_merge([
                'addPartName.' . $i => ['required'],
                'addPartQuantity.' . $i => ['required'],
                'addPartType.' . $i => ['required'],
            ],
                $addPartStockNo,
                $addPartPrice
            );
        }
        return [
            'addPartName' => ['required'],
        ];
    }

//    protected function formatErrors(Validator $validator)
//    {
//        $messages = $validator->messages();
//        foreach ($messages->all() as $message){
//            Toastr::error($message, 'Failed', ['timeOut' => 10000]);
//        }
//    }

    public function checkClientInputs()
    {
        if ($this->request->get('inputClientPhone')){
            return [
                'inputClientPhone' => ['required'],
            ];
        } elseif ($this->request->get('inputClientEmail')){
            return [
                'inputClientEmail' => ['required', 'email'],
            ];
        } else {
            return [
                'inputClientPhone' => ['required'],
                'inputClientEmail' => ['required', 'email'],
            ];
        }

    }
}
