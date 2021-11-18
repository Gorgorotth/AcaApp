<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeMechanicPasswordRequest;
use App\Http\Requests\EditMechanicProfileRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Mechanic;
use App\Services\Mechanics\InvoiceService;
use App\Services\Mechanics\MechanicService;

class MechanicController extends Controller
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
     * @param InvoiceService $invoiceService
     */
    public function __construct(InvoiceService $invoiceService, MechanicService $mechanicService)
    {
        $this->invoiceService = $invoiceService;
        $this->mechanicService = $mechanicService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (request()->sortByCreatedDate == null) {
            request()->merge([
                'sortByCreatedDate' => 1,
            ]);
        }

        return view('mechanic.invoices.index', [
            'invoices' => $this->invoiceService->dashboard(request(), auth()->user()->garage_id),
            'orderBy' => request()->sortByCreatedDate == 1 ? 0 : 1,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editProfile()
    {
        $mechanic = $this->mechanicService->getMechanic(auth()->id());
        return view('mechanic.edit-profile', [
            'name' => $mechanic->name,
            'email' => $mechanic->email,
        ]);
    }

    /**
     * @param EditMechanicProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editMechanicProfile(EditMechanicProfileRequest $request)
    {
        $message = $this->mechanicService->editProfile($request, auth()->id());
        if ($message->getSuccess()) {
            return back()->with('success', $message->getMessage());
        }

        return back()->with('error', $message->getMessage());
    }


    /**
     * @param ChangeMechanicPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeMechanicPassword(ChangeMechanicPasswordRequest $request)
    {
        $message = $this->mechanicService->updatePassword($request, auth()->id());
        if ($message->getSuccess()) {
            return back()->with('success', $message->getMessage());
        }
        return back()->with('error', $message->getMessage());
    }

    /**
     * @param $invoiceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showInvoice($invoiceId)
    {
        $invoice = $this->invoiceService->getInvoice($invoiceId);
        return view('mechanic.invoices.show-invoice', [
            'invoice' => $invoice,
            'invoiceParts' => $invoice->parts,
            'client' => $invoice->client,
            'mechanicName' => auth()->user()->name,
            'currency' => $this->invoiceService->getCurrency(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createInvoice()
    {
        return view('mechanic.invoices.create', [
            'currency' => $this->invoiceService->getCurrency(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeInvoice(StoreInvoiceRequest $request)
    {
        $invoice = $this->invoiceService->storeInvoice(auth()->user()->garage_id, auth()->id(), $request);
        if ($invoice->getSuccess()) {
            return redirect(route('mechanic.dashboard'))->with('success', $invoice->getMessage());
        }
        return redirect(route('mechanic.dashboard'))->with('error', $invoice->getMessage());
    }

    /**
     * @param $invoiceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteInvoice($invoiceId)
    {
        $invoice = $this->invoiceService->deleteInvoice($invoiceId, auth()->id());
        if ($invoice->getSuccess()) {
            return redirect(route('mechanic.dashboard'))->with('success', $invoice->getMessage());
        }
        return back()->with('error', $invoice->getMessage());

    }

    /**
     * @param $invoiceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function exportPdf($invoiceId)
    {
        $invoice = $this->invoiceService->exportInvoiceToPdf($invoiceId);
        if ($invoice->getSuccess()) {
            return redirect(route('mechanic.dashboard'))->with('success', $invoice->getMessage());
        }
        return back()->with('error', $invoice->getMessage());

    }
}
