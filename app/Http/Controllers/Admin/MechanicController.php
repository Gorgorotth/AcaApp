<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMechanicRequest;
use App\Http\Requests\Admin\UpdateMechanicRequest;
use App\Models\Mechanic;
use App\Services\Admin\GarageService;
use App\Services\Admin\MechanicService;

class MechanicController extends Controller
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
    public function createMechanic()
    {
        return view('admin.mechanic.create');
    }

    /**
     * @param StoreMechanicRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeMechanic(StoreMechanicRequest $request)
    {
        if ($this->mechanicService->storeMechanic($request)) {
            return redirect(route('admin.mechanic-dashboard'))->with('success', 'You created a mechanic');
        }
        return back()->with('error', 'Something went wrong');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function mechanicDashboard()
    {
        return view('admin.mechanic.dashboard', [
            'mechanics' => $this->mechanicService->dashboard(request()->search, Mechanic::class),
            'orderBy' => request()->sortByCreatedDate
        ]);
    }

    /**
     * @param $mechanicId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($mechanicId)
    {
        return view('admin.mechanic.edit', [
            'mechanic' => $this->mechanicService->getMechanic($mechanicId),
            'garages' => $this->garageService->getAllGarages()
        ]);
    }

    /**
     * @param UpdateMechanicRequest $request
     * @param $mechanicId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMechanicRequest $request, $mechanicId)
    {

        if ($this->mechanicService->updateMechanic($request, $mechanicId)) {
            return back()->with('success', 'Mechanic data updated');
        }
        return back()->with('error', 'Something went wrong');

    }

    /**
     * @param $mechanicId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteMechanic($mechanicId)
    {

        if ($this->mechanicService->deleteMechanic($mechanicId)) {
            return back()->with('success', 'Mechanic is deleted');
        }
        return back()->with('error', 'Something went wrong');

    }
}
