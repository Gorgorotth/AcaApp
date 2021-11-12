<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGarageRequest;
use App\Services\Admin\GarageService;
use App\Services\Admin\InvoiceService;
use App\Services\Admin\MechanicService;

class AdminController extends Controller
{
    /**
     * @var InvoiceService
     */
    public $invoiceService;
    public $mechanicService;
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

    public function createGarage()
    {
        return view('admin.garage.create',[
            'mechanics' => $this->mechanicService->getUnemployedMechanics()
        ]);
    }

    public function showInvoice($invoiceId)
    {
        $invoice = $this->invoiceService->showInvoice($invoiceId);
        return view('admin.show-invoice', [
            'invoice' => $invoice['invoice'],
            'invoiceParts' => $invoice['invoiceParts'],
            'client' => $invoice['client'],
            'mechanicName' => auth()->user()->name,
            'currency' => $invoice['currency'],
        ]);
    }

    public function storeGarage(StoreGarageRequest $request)
    {
        try {
            $this->garageService->storeGarage($request);
            return redirect(route('admin.dashboard'))->with('success', 'Garage Created');
        }catch (\Exception $e){
            captureException($e);
            return back()->with('error', 'Something went wrong');
        }
    }

    public function index()
    {
        return view('admin.dashboard',[
            'invoices' => $this->invoiceService->adminDashboard(request()->search),
            'orderBy' => request()->sortByCreatedDate
        ]);
    }
}
