<?php

namespace App\Services\Admin;

use App\Models\Garage;
use App\Models\Mechanic;

class MechanicService
{
    public function getUnemployedMechanics()
    {
        return Mechanic::query()->whereNull('garage_id')->get();
    }

    public function getAllMechanics()
    {
        return Mechanic::all();
    }

    public function storeMechanic($request)
    {
        Mechanic::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
    }

    public function editMechanic($mechanicId)
    {
        $mechanic = Mechanic::find($mechanicId);
        $garages = Garage::all();
        return [
            'mechanic' => $mechanic,
            'garages' => $garages
        ];
    }

    public function updateMechanic($request, $mechanicId)
    {

//        dd($request->email);
        if ($request->name) {
            Mechanic::query()->where('id', $mechanicId)->update(['name' => $request->name]);
        }

        if ($request->email) {
            Mechanic::query()->where('id', $mechanicId)->update(['email' => $request->email]);
        }

        if ($request->garage) {
            Mechanic::query()->where('id', $mechanicId)->update(['garage_id' => $request->garage]);
        }
    }

    public function deleteMechanic($mechanicId)
    {
        Mechanic::query()->firstWhere('id', $mechanicId)->delete();
    }
}