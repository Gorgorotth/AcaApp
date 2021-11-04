<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Invoice;
use App\Services\Mechanics\InvoiceService;

class MechanicController extends Controller
{
    /**
     * @var InvoiceService
     */
    public $invoiceService;

    /**
     * @param InvoiceService $invoiceService
     */
    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('mechanic.invoices.dashboard', [
            'invoices' => Invoice::query()->where('garage_id', auth()->user()->garage_id)->get(),
        ]);
    }

    /**
     * @param $invoiceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showInvoice($invoiceId)
    {
        $invoice = $this->invoiceService->showInvoice($invoiceId);
        return view('mechanic.invoices.show-invoice', [
            'invoice' => $invoice['invoice'],
            'invoiceParts' => $invoice['invoiceParts'],
            'mechanicName' => auth()->user()->name,
            'currency' => $invoice['currency'],
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createInvoice()
    {
        return view('mechanic.invoices.create', [
            'currency' => trans('garage.currency'),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeInvoice(StoreInvoiceRequest $request)
    {
        try {
            $this->invoiceService->storeInvoice(auth()->user()->garage_id, auth()->id(), $request);
            return redirect(route('home'))->with('success', 'You just create a new invoice');
        } catch (\Exception $e) {
            return redirect(route('home'))->with('error', 'Something went wrong');
        }
    }

    /**
     * @param $invoiceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteInvoice($invoiceId)
    {
        try {
            $this->invoiceService->deleteInvoice($invoiceId, auth()->id());
            return redirect(route('home'))->with('success', 'Invoice Deleted');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * @param $invoiceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function exportPdf($invoiceId)
    {
        try {
            $this->invoiceService->exportInvoiceToPdf($invoiceId);
            return redirect(route('home'))->with('success', 'You successfully exported invoice file to Pdf');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }
}
