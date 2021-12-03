<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGarageRequest;
use App\Http\Requests\Admin\UpdateGarageRequest;
use App\Models\Garage;
use App\Services\Admin\GarageService;
use App\Services\Admin\MechanicService;

class GarageController extends Controller
{

    /**
     * @var MechanicService
     */
    protected $mechanicService;
    /**
     * @var GarageService
     */
    protected $garageService;

    /**
     * @param MechanicService $mechanicService
     * @param GarageService $garageService
     */
    public function __construct(MechanicService $mechanicService, GarageService $garageService)
    {
        $this->mechanicService = $mechanicService;
        $this->garageService = $garageService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.garage.index', [
            'garages' => $this->garageService->garageDashboard(request()),
            'orderBy' => request()->sortByCreatedDate == Garage::SORT_ASC ? Garage::SORT_DESC : Garage::SORT_ASC
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.garage.create', [
            'unemployedMechanics' => $this->mechanicService->getUnemployedMechanics()
        ]);
    }

    /**
     * @param StoreGarageRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreGarageRequest $request)
    {
        $garage = $this->garageService->storeGarage($request);
        if ($garage->getSuccess()) {
            return redirect(route('admin.garage.index'))->with('success', $garage->getMessage());
        }
        return back()->with('error', $garage->getMessage());
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return view('admin.garage.edit', [
            'garage' => $this->garageService->getGarage($id),
            'garageEmails' => $this->garageService->getEmailsForGarage($id),
            'garageMechanics' => $this->garageService->getMechanicsForGarage($id),
            'unemployedMechanics' => $this->mechanicService->getUnemployedMechanics(),
            'deletedEmails' => $this->garageService->getDeletedEmailsForGarage($id)
        ]);
    }

    /**
     * @param UpdateGarageRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGarageRequest $request, $id)
    {
        $garage = $this->garageService->updateGarage($request, $id);
        if ($garage->getSuccess()) {
            return back()->with('success', $garage->getMessage());
        }
        return back()->with('error', $garage->getMessage());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $garage = $this->garageService->deleteGarage($id);
        if ($garage->getSuccess()) {
            return back()->with('success', $garage->getMessage());
        }
        return back()->with('error', $garage->getMessage());
    }

    /**
     * @param $mechanicId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeMechanic($mechanicId)
    {
        $mechanic = $this->garageService->removeMechanic($mechanicId);
        if ($mechanic->getSuccess()) {
            return back()->with('success', $mechanic->getMessage());
        }
        return back()->with('error', $mechanic->getMessage());
    }

    /**
     * @param $emailId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteEmail($emailId)
    {
        $email = $this->garageService->deleteEmail($emailId);
        if ($email->getSuccess()) {
            return back()->with('success', $email->getMessage());
        }
        return back()->with('error', $email->getMessage());
    }

    /**
     * @param $emailId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreEmail($emailId)
    {
        $email = $this->garageService->restoreEmail($emailId);
        if ($email->getSuccess()) {
            return back()->with(['success' => $email->getMessage(), 'checkboxChecked' => 'checked']);
        }
        return back()->with('error', $email->getMessage());
    }
}
