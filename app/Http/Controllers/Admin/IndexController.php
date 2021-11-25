<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Services\Admin\GarageService;
use App\Services\Admin\InvoiceService;
use App\Services\Admin\MechanicService;

class IndexController extends Controller
{
    /**
     * @var InvoiceService
     */
    public $invoiceService;
    /**
     * @var MechanicService
     */
    public $mechanicService;
    /**
     * @var GarageService
     */
    public $garageService;

    /**
     * @param InvoiceService $invoiceService
     */
    public function __construct(
        InvoiceService $invoiceService,
        MechanicService $mechanicService,
        GarageService $garageService
    ) {
        $this->invoiceService = $invoiceService;
        $this->mechanicService = $mechanicService;
        $this->garageService = $garageService;
    }

    /**
     * @param $invoiceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showInvoice($invoiceId)
    {
        $invoice = $this->invoiceService->getInvoice($invoiceId);
        return view('admin.show-invoice', [
            'invoice' => $invoice,
            'invoiceParts' => $invoice->parts,
            'client' => $invoice->client,
            'mechanicName' => $invoice->author->name,
            'currency' => $this->invoiceService->getCurrency(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.index', [
            'invoices' => $this->invoiceService->invoiceDashboard(request()),
            'orderBy' => request()->sortByCreatedDate == Invoice::SORT_ASC ? Invoice::SORT_DESC : Invoice::SORT_ASC
        ]);
    }
}
