<?php

namespace App\Services\Mechanics;

use App\Models\Client;
use App\Models\Garage;
use App\Models\Invoice;
use App\Models\InvoicePart;
use App\Services\ResponseService;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoiceService
{

    /**
     * @param Request $request
     * @param $garageId
     * @return LengthAwarePaginator
     */
    public function dashboard(Request $request, $garageId):LengthAwarePaginator
    {
        $invoices = Invoice::query()->where('garage_id', $garageId);

        if ($request->search) {
            $invoices->filter(['search' => $request->search]);
        }

        if ($request->sortByCreatedDate == Invoice::SORT_DESC) {
            $invoices->orderByDesc('created_at');
        } else {
            $invoices->orderBy('created_at');
        }

        return $invoices->paginate(6);
    }

    /**
     * @param $invoiceId
     * @param $authorId
     * @return ResponseService
     */
    public function deleteInvoice($invoiceId, $authorId): ResponseService
    {
        try {
            DB::beginTransaction();
            $invoice = $this->getInvoice($invoiceId);
            if ($this->checkAuthor($invoice, $authorId)) {
                $invoice->delete();
                $invoiceParts = $invoice->parts;
                foreach ($invoiceParts as $part) {
                    $part->delete();
                }
                DB::commit();
                return ResponseService::response(true, 'Invoice Deleted');
            }
        } catch (\Exception $e) {
            captureException($e);
            DB::rollBack();
        }
        return ResponseService::response(false, 'Something went wrong');
    }

    /**
     * @param $invoiceId
     * @return mixed
     */
    public function getInvoice($invoiceId)
    {
        return Invoice::find($invoiceId);
    }


    /**
     * @param Invoice $invoice
     * @param $authorId
     * @return bool
     */
    public function checkAuthor(Invoice $invoice, $authorId): bool
    {
       return $invoice->mechanic_id == $authorId;
    }

    /**
     * @param $garageId
     * @param $mechanicId
     * @return ResponseService
     */
    public function storeInvoice($garageId, $mechanicId, $request): ResponseService
    {
        try {
            DB::beginTransaction();
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
            $invoice->invoice_number = 'INV' . $invoice->id;
            $invoice->save();
            DB::commit();
            return ResponseService::response(true, 'You just create a new invoice');
        } catch (\Exception $e) {
            captureException($e);
            DB::rollBack();
        }
        return ResponseService::response(false, 'Something went wrong');
    }

    /**
     * @param $invoiceId
     * @return ResponseService
     */
    public function exportInvoiceToPdf($invoiceId): ResponseService
    {
        try {
            $invoice = $this->getInvoice($invoiceId);
            $data = [
                'invoice' => $invoice,
                'invoiceParts' => $invoice->parts,
                'mechanicName' => auth()->user()->name,
                'currency' => $this->getCurrency(),
            ];
            $pdf = PDF::loadView('mechanic.invoices.exportPdf', $data);
            Storage::disk('public')->put('invoice: ' . $invoice['license_plate'] . '.pdf', $pdf->output());
            return ResponseService::response(true, 'You successfully exported invoice file to Pdf');
        } catch (\Exception $e) {
            captureException($e);
        }
        return ResponseService::response(false, 'Something went wrong');
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getCurrency()
    {
        return trans('garage.currency');
    }
}