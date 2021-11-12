<?php

namespace App\Services\Mechanics;

use App\Models\Client;
use App\Models\Garage;
use App\Models\Invoice;
use App\Models\InvoicePart;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;


class InvoiceService
{
    /**
     * @param $request
     * @param $garageId
     * @param $orderBy
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function dashboard($request, $garageId)
    {
        if (!request()->sortByCreatedDate) {
            request()->sortByCreatedDate = 1;
        } else {
            request()->sortByCreatedDate = 0;
        }

        if ($request) {
            $invoices = Invoice::query()->where('garage_id', $garageId)->latest()->filter(request(['search']))->paginate(6)->withQueryString();
        } elseif (request()->sortByCreatedDate == 1) {
            $invoices = Invoice::query()->where('garage_id', $garageId)->orderByDesc('created_at')->get();
        } else {
            $invoices = Invoice::query()->where('garage_id', $garageId)->orderBy('created_at')->get();
        }
        return $invoices;
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
     * @param $invoiceId
     * @return Invoice
     */
    public function getInvoice($invoiceId): Invoice
    {
        return Invoice::find($invoiceId);
    }

    /**
     * @param $invoice
     * @param $authorId
     * @return bool
     */
    public function checkAuthor($invoice, $authorId): bool
    {
        if ($invoice['mechanic_id'] == $authorId) {
            return true;
        } else {
            return false;
        }
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
     * @param $garageId
     * @param $mechanicId
     */
    public function storeInvoice($garageId, $mechanicId, $request)
    {
        $totalPrice = 0;
        $garage = Garage::query()->firstWhere('id', $garageId);
        $client = Client::query()->create([
            'name' => $request->inputClientName,
            'last_name' => $request->inputClientLastName,
            'phone' => $request->inputClientPhone,
            'email' => $request->inputClientEmail
        ]);
        $invoice = Invoice::query()->create([
            'garage_id' => $garageId,
            'mechanic_id' => $mechanicId,
            'client_id' => $client->id,
            'vin' => $request->inputVin,
            'license_plate' => $request->inputPlate,
            'brand' => $request->inputBrand,
            'model' => $request->inputModel,
            'total_price' => 123,
            'hourly_price' => $garage->hourly_rate,
        ]);

        foreach ($request->addPartName as $i => $part) {
            $quantity = $request->addPartQuantity[$i];

            if ($request->addPartType[$i] == InvoicePart::JOB_TYPE_WORK) {
                $addPrice = $garage->hourly_rate;
            } else {
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
     * @param $invoiceId
     */
    public function exportInvoiceToPdf($invoiceId)
    {
        $invoice = $this->showInvoice($invoiceId);
        $data = [
            'invoice' => $invoice['invoice'],
            'invoiceParts' => $invoice['invoiceParts'],
            'mechanicName' => auth()->user()->name,
            'currency' => $invoice['currency'],
        ];
        $pdf = PDF::loadView('mechanic.invoices.exportPdf', $data);
        Storage::disk('public')->put('invoice: ' . $invoice['invoice']['license_plate'] . '.pdf', $pdf->output());
    }

    /**
     * @param $invoiceId
     * @return array
     */
    public function showInvoice($invoiceId): array
    {
        $invoice = $this->getInvoice($invoiceId);
        $invoiceParts = $this->getInvoiceParts($invoiceId);
        $client = $this->getClient($invoice->client_id);
        return [
            'invoice' => $invoice,
            'invoiceParts' => $invoiceParts,
            'client' => $client,
            'currency' => trans('garage.currency')
        ];
    }

    public function getClient($clientId)
    {
        return Client::find($clientId);
    }
}