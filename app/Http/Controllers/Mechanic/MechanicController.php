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
        return view('mechanic.invoices.dashboard', [
            'invoices' => $this->invoiceService->dashboard(request()->search, auth()->user()->garage_id),
            'orderBy' => request()->sortByCreatedDate
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editProfile()
    {
        $mechanic = Mechanic::find(auth()->id());
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
        if ($this->mechanicService->editProfile($request, auth()->id())) {
            return back()->with('success', 'Profile updated successfully');
        }
        return back()->with('error', 'Something went wrong');
    }

    /**
     * @param ChangeMechanicPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeMechanicPassword(ChangeMechanicPasswordRequest $request)
    {
        if ($this->mechanicService->updatePassword($request, auth()->id())) {
            return back()->with('success', 'You successfully update your password');
        }
        return back()->with('error', 'Something went wrong');
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
            'invoiceParts' => $this->invoiceService->getInvoiceParts($invoiceId),
            'client' => $this->invoiceService->getClient($invoice['client_id']),
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
        if ($this->invoiceService->storeInvoice(auth()->user()->garage_id, auth()->id(), $request)) {
            return redirect(route('mechanic.dashboard'))->with('success', 'You just create a new invoice');
        }
        return redirect(route('mechanic.dashboard'))->with('error', 'Something went wrong');
    }

    /**
     * @param $invoiceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteInvoice($invoiceId)
    {


        if ($this->invoiceService->deleteInvoice($invoiceId, auth()->id())) {
            return redirect(route('mechanic.dashboard'))->with('success', 'Invoice Deleted');
        }
        return back()->with('error', 'Something went wrong');

    }

    /**
     * @param $invoiceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function exportPdf($invoiceId)
    {
        if ($this->invoiceService->exportInvoiceToPdf($invoiceId)) {
            return redirect(route('mechanic.dashboard'))->with('success',
                'You successfully exported invoice file to Pdf');
        }
        return back()->with('error', 'Something went wrong');

    }
}
