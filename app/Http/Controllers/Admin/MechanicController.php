<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMechanicRequest;
use App\Http\Requests\Admin\UpdateMechanicRequest;
use App\Models\Mechanic;
use App\Services\Admin\GarageService;
use App\Services\Admin\MechanicService;
use Illuminate\Http\Request;

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

    public function index()
    {
        return view('admin.mechanic.index', [
            'mechanics' => $this->mechanicService->mechanicDashboard(request()),
            'orderBy' => request()->sortByCreatedDate == 1 ? 0 : 1
        ]);
    }

    public function create()
    {
        return view('admin.mechanic.create');
    }

    public function store(StoreMechanicRequest $request)
    {
        $mechanic = $this->mechanicService->storeMechanic($request);
        if ($mechanic->getSuccess()) {
            return redirect(route('admin.mechanic.index'))->with('success', $mechanic->getMessage());
        }
        return back()->with('error', $mechanic->getMessage());
    }

    public function edit($id)
    {
        return view('admin.mechanic.edit', [
            'mechanic' => $this->mechanicService->getMechanic($id),
            'garages' => $this->garageService->getAllGarages()
        ]);
    }

    public function update(UpdateMechanicRequest $request, $id)
    {
        $mechanic = $this->mechanicService->updateMechanic($request, $id);
        if ($mechanic->getSuccess()) {
            return back()->with('success', $mechanic->getMessage());
        }
        return back()->with('error', $mechanic->getMessage());
    }

    public function destroy($id)
    {
        $mechanic = $this->mechanicService->deleteMechanic($id);
        if ($mechanic->getSuccess()) {
            return back()->with('success', $mechanic->getMessage());
        }
        return back()->with('error', $mechanic->getMessage());
    }
}
