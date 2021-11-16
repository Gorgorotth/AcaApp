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
    public $mechanicService;
    /**
     * @var GarageService
     */
    public $garageService;

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
    public function createGarage()
    {
        return view('admin.garage.create', [
            'unemployedMechanics' => $this->mechanicService->getUnemployedMechanics()
        ]);
    }

    /**
     * @param StoreGarageRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeGarage(StoreGarageRequest $request)
    {
        if ($this->garageService->storeGarage($request)) {
            return redirect(route('admin.garage-dashboard'))->with('success', 'Garage Created');
        }
        return back()->with('error', 'Something went wrong');

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function garageDashboard()
    {
        return view('admin.garage.dashboard', [
            'garages' => $this->mechanicService->dashboard(request()->search, Garage::class),
            'orderBy' => request()->sortByCreatedDate
        ]);
    }

    /**
     * @param $emailId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteEmail($emailId)
    {
        if ($this->garageService->deleteEmail($emailId)) {
            return back()->with('success', 'Email is deleted');
        }
        return back()->with('error', 'Something went wrong');
    }

    /**
     * @param $emailId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreEmail($emailId)
    {
        if ($this->garageService->restoreEmail($emailId)) {
            return back()->with('success', 'Email restored');
        }
        return back()->with('error', 'Something went wrong');
    }

    /**
     * @param $mechanicId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeMechanic($mechanicId)
    {
        if ($this->garageService->removeMechanic($mechanicId)) {
            return back()->with('success', 'Mechanic is removed');
        }
        return back()->with('error', 'Something went wrong');

    }

    /**
     * @param $garageId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($garageId)
    {
        return view('admin.garage.edit', [
            'garage' => $this->garageService->getGarage($garageId),
            'garageEmails' => $this->garageService->getEmailsForGarage($garageId),
            'garageMechanics' => $this->garageService->getMechanicsForGarage($garageId),
            'unemployedMechanics' => $this->mechanicService->getUnemployedMechanics(),
            'deletedEmails' => $this->garageService->getDeletedEmailsForGarage($garageId)
        ]);
    }

    /**
     * @param UpdateGarageRequest $request
     * @param $garageId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGarageRequest $request, $garageId)
    {
        if ($this->garageService->updateGarage($request, $garageId)) {
            return back()->with('success', 'Update Successful');
        }
        return back()->with('error', 'Something went wrong');
    }

    /**
     * @param $garageId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteGarage($garageId)
    {
        if ($this->garageService->deleteGarage($garageId)) {
            return back()->with('success', 'Garage deleted successfully');
        }
        return back()->with('error', 'Something went wrong');
    }
}
