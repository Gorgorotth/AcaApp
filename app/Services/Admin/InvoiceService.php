<?php

namespace App\Services\Admin;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoicePart;

class InvoiceService
{
    public function adminDashboard($request)
    {
        $invoices = Invoice::query();

        if ($request) {
            $invoices->filter(request(['search']));
        }

        if (request()->sortByCreatedDate == 1) {
            $invoices = $invoices->orderByDesc('created_at');
        } else if(request()->sortByCreatedDate == 0) {
            $invoices = $invoices->orderBy('created_at');
        } else {
            $invoices = $invoices->latest();
        }

        return $invoices->paginate(6);
    }

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

    public function getInvoice($invoiceId)
    {
        return Invoice::find($invoiceId);
    }

    public function getInvoiceParts($invoiceId)
    {
        return InvoicePart::query()->where('invoice_id', $invoiceId)->get();
    }

    public function getClient($clientId)
    {
        return Client::find($clientId);
    }
}