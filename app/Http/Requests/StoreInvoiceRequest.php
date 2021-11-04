<?php

namespace App\Http\Requests;

use App\Models\InvoicePart;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize()
//    {
//        return false;
//    }

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
        ],
            $this->rats()
        );
    }

    public function rats()
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
    }
}
