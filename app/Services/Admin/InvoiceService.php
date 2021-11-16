<?php

namespace App\Services\Admin;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoicePart;

class InvoiceService
{

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getCurrency()
    {
        return trans('garage.currency');
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
     * @param $invoiceId
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getInvoiceParts($invoiceId)
    {
        return InvoicePart::query()->where('invoice_id', $invoiceId)->get();
    }

    /**
     * @param $clientId
     * @return mixed
     */
    public function getClient($clientId)
    {
        return Client::find($clientId);
    }
}