<?php

namespace App\Services\Admin;

use App\Models\Invoice;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
     * @param $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function invoiceDashboard($request): LengthAwarePaginator
    {
        if ($request->search) {
            if ($request->sortByCreatedDate == 1) {
                $invoices = Invoice::query()->filter(['search' => $request->search])->orderByDesc('created_at');
            } else {
                $invoices = Invoice::query()->filter(['search' => $request->search])->orderBy('created_at');
            }
        } else {
            if ($request->sortByCreatedDate == 1) {
                $invoices = Invoice::query()->orderByDesc('created_at');
            } else {
                $invoices = Invoice::query()->orderBy('created_at');
            }
        }
        return $invoices->paginate(6);
    }

    /**
     * @param $invoiceId
     * @return mixed
     */
    public function getInvoice($invoiceId)
    {
        return Invoice::find($invoiceId);
    }
}