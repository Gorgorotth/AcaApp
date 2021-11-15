<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMechanicRequest;
use App\Http\Requests\Admin\UpdateMechanicRequest;
use App\Services\Admin\GarageService;
use App\Services\Admin\MechanicService;

class MechanicController extends Controller
{
    public $mechanicService;

    public $garageService;

    public function __construct(MechanicService $mechanicService, GarageService $garageService)
    {
        $this->mechanicService = $mechanicService;
        $this->garageService = $garageService;
    }

    public function createMechanic()
    {
        return view('admin.mechanic.create');
    }

    public function storeMechanic(StoreMechanicRequest $request)
    {
        try {
            $this->mechanicService->storeMechanic($request);
            return redirect(route('admin.mechanic-dashboard'))->with('success', 'You created a mechanic');
        } catch (\Exception $e){
            captureException($e);
            return back()->with('error', 'Something went wrong');
        }
    }

    public function mechanicDashboard()
    {
        return view('admin.mechanic.dashboard',[
            'mechanics' => $this->mechanicService->getAllMechanics()
        ]);
    }

    public function edit($mechanicId)
    {
        return view('admin.mechanic.edit',[
            'mechanic' => $this->mechanicService->getMechanic($mechanicId),
            'garages' => $this->garageService->getAllGarages()
        ]);
    }

    public function update(UpdateMechanicRequest $request, $mechanicId)
    {
        try {
            $this->mechanicService->updateMechanic($request, $mechanicId);
            return back()->with('success', 'Mechanic data updated');
        }catch (\Exception $e){
            captureException($e);
            return back()->with('error', 'Something went wrong');
        }
    }

    public function deleteMechanic($mechanicId)
    {
        try {
        $this->mechanicService->deleteMechanic($mechanicId);
        return back()->with('success', 'Mechanic is deleted');
        }catch (\Exception $e){
            return back()->with('error', 'Something went wrong');
        }
    }
}
