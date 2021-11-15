<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\GarageService;
use App\Services\Admin\InvoiceService;
use App\Services\Admin\MechanicService;

class AdminController extends Controller
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
    public function __construct(InvoiceService $invoiceService, MechanicService $mechanicService, GarageService $garageService)
    {
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
            'invoiceParts' => $this->invoiceService->getInvoiceParts($invoiceId),
            'client' => $this->invoiceService->getClient($invoice['client_id']),
            'mechanicName' => auth()->user()->name,
            'currency' => $this->invoiceService->getCurrency(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.dashboard',[
            'invoices' => $this->invoiceService->adminDashboard(request()->search),
            'orderBy' => request()->sortByCreatedDate
        ]);
    }
}
