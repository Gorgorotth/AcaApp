<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGarageRequest;
use App\Http\Requests\Admin\UpdateGarageRequest;
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
        return view('admin.garage.create',[
            'unemployedMechanics' => $this->mechanicService->getUnemployedMechanics()
        ]);
    }

    /**
     * @param StoreGarageRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function  storeGarage(StoreGarageRequest $request)
    {
        try {
            $this->garageService->storeGarage($request);
            return redirect(route('admin.garage-dashboard'))->with('success', 'Garage Created');
        }catch (\Exception $e){
            captureException($e);
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function garageDashboard()
    {
        return view('admin.garage.dashboard',[
            'garages' => $this->garageService->getAllGarages()
        ]);
    }

    /**
     * @param $emailId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteEmail($emailId)
    {
        try {
            $this->garageService->deleteEmail($emailId);
            return back()->with('success', 'Email is deleted');
        }catch (\Exception $e){
            captureException($e);
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * @param $emailId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreEmail($emailId)
    {
        try {
            $this->garageService->restoreEmail($emailId);
            return back()->with('success', 'Email restored');
        }catch (\Exception $e){
            captureException($e);
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * @param $mechanicId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeMechanic($mechanicId)
    {
        try {
            $this->garageService->removeMechanic($mechanicId);
            return back()->with('success', 'Mechanic is removed');
        }catch (\Exception $e){
            captureException($e);
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * @param $garageId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($garageId)
    {
        return view('admin.garage.edit',[
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
        try {
            $this->garageService->updateGarage($request, $garageId);
            return back()->with('success', 'Update Successful');
        }catch (\Exception $e){
            captureException($e);
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * @param $garageId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteGarage($garageId)
    {
        try {
            $this->garageService->deleteGarage($garageId);
            return back()->with('success', 'Garage deleted successfully');
        }catch (\Exception $e){
            captureException($e);
            return back()->with('error', 'Something went wrong');
        }
    }
}
