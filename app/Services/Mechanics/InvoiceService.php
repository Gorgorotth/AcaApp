<?php

namespace App\Services\Mechanics;

use App\Models\Garage;
use App\Models\Invoice;
use App\Models\InvoicePart;
use Illuminate\Support\Collection;


class InvoiceService
{
    /**
     * @param $invoiceId
     * @return Invoice
     */
    public function getInvoice($invoiceId): Invoice
    {
        return Invoice::find($invoiceId);
    }

    /**
     * @param $invoiceId
     * @return Collection
     */
    public function getInvoiceParts($invoiceId): Collection
    {
        return InvoicePart::query()->where('invoice_id', $invoiceId)->get();
    }

    /**
     * @param $invoiceId
     * @return array
     */
    public function showInvoice($invoiceId): array
    {
        $invoice = $this->getInvoice($invoiceId);
        $invoiceParts = $this->getInvoiceParts($invoiceId);
        foreach ($invoiceParts as $part) {
            $part['total_price'] = $part['price'] * $part['quantity'];
        }
        return [
            'invoice' => $invoice,
            'invoiceParts' => $invoiceParts,
            'currency' => trans('garage.currency')
        ];
    }

    /**
     * @param $invoiceId
     * @param $authorId
     * @return bool
     */
    public function deleteInvoice($invoiceId, $authorId): bool
    {
        $invoice = $this->getInvoice($invoiceId);
        if ($this->checkAuthor($invoice, $authorId)) {
            $invoice->delete();
            $invoiceParts = $this->getInvoiceParts($invoiceId);
            foreach ($invoiceParts as $part) {
                $part->delete();
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $garageId
     * @param $mechanicId
     */
    public function storeInvoice($garageId, $mechanicId, $request)
    {
        $totalPrice = 0;
        $garage = Garage::query()->firstWhere('id', $garageId);
        $invoice = Invoice::query()->create([
            'garage_id' => $garageId,
            'mechanic_id' => $mechanicId,
            'vin' => $request->inputVin,
            'license_plate' => $request->inputPlate,
            'brand' => $request->inputBrand,
            'model' => $request->inputModel,
            'total_price' => 123,
            'hourly_price' => $garage->hourly_rate,
        ]);

        foreach ($request->addPartName as $i => $part)
        {
            $quantity = $request->addPartQuantity[$i];

            if ($request->addPartType[$i] == InvoicePart::JOB_TYPE_WORK){
                $addPrice = $garage->hourly_rate;
            }else {
                $addPrice = $request->addPartPrice[$i];
            }
            InvoicePart::query()->create([
                'invoice_id' => $invoice->id,
                'name' => $request->addPartName[$i],
                'stock_no' => $request->addPartStockNo[$i],
                'quantity' => $quantity,
                'price' => $addPrice,
                'job_type' => $request->addPartType[$i]
            ]);
            $totalPrice += $addPrice * $quantity;
        }
        $invoice->total_price = $totalPrice;
        $invoice->save();
    }

    /**
     * @param $invoice
     * @param $authorId
     * @return bool
     */
    public function checkAuthor($invoice, $authorId): bool
    {
        if ($invoice['mechanic_id'] == $authorId){
            return true;
        } else{
            return false;
        }
    }
}