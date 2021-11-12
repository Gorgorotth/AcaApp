<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMechanicRequest;
use App\Http\Requests\Admin\UpdateMechanicRequest;
use App\Models\Mechanic;
use App\Services\Admin\MechanicService;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    public $mechanicService;

    public function __construct(MechanicService $mechanicService)
    {
        $this->mechanicService = $mechanicService;
    }

    public function createMechanic()
    {
        return view('admin.mechanic.create');
    }

    public function storeMechanic(StoreMechanicRequest $request)
    {
        try {
            $this->mechanicService->storeMechanic($request);
            return redirect(route('admin.mechanic.dashboard'))->with('success', 'You created a mechanic');
        } catch (Exception $e){
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
        $mechanic = $this->mechanicService->editMechanic($mechanicId);
        session()->put('mechanicId', $mechanicId);
        return view('admin.mechanic.edit',[
            'name' => $mechanic['mechanic']->name,
            'email' => $mechanic['mechanic']->email,
            'garages' => $mechanic['garages']
        ]);
    }

    public function update(UpdateMechanicRequest $request)
    {
        try {
            $this->mechanicService->updateMechanic($request, session()->get('mechanicId'));
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
