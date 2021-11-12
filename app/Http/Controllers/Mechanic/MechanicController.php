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

    public function editProfile()
    {
        $mechanic = Mechanic::find(auth()->id());
        return view('mechanic.edit-profile', [
            'name' => $mechanic->name,
            'email' => $mechanic->email,
        ]);
    }

    public function editMechanicProfile(EditMechanicProfileRequest $request)
    {
        try {
            $this->mechanicService->editProfile($request, auth()->id());
            return back(['messages' => $request->messages()])->with('success', 'Profile updated successfully');
        } catch (\Exception $e){
            captureException($e);
            return back()->with('error', 'Something went wrong');
        }
    }

    public function changeMechanicPassword(ChangeMechanicPasswordRequest $request)
    {
        try {
            if ($this->mechanicService->updatePassword($request, auth()->id()))
            return back()->with('success', 'You successfully update your password');
            else return back()->with('error', 'Wrong password');
        } catch (\Exception $e){
            captureException($e);
            return back()->with('error', 'Something went wrong');
        }
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
            'client' => $invoice['client'],
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
            captureException($e);
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
