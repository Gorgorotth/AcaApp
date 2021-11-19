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
        $invoices = Invoice::query();

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
     * @return mixed
     */
    public
    function getInvoice(
        $invoiceId
    ) {
        return Invoice::find($invoiceId);
    }
}