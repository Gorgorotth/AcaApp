<?php

namespace App\Services\Admin;

use App\Models\Garage;
use App\Models\Mechanic;
use Illuminate\Support\Facades\DB;

class MechanicService
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUnemployedMechanics()
    {
        return Mechanic::query()->whereNull('garage_id')->get();
    }

    /**
     * @return Mechanic[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllMechanics()
    {
        return Mechanic::all();
    }

    /**
     * @param $mechanicId
     * @return mixed
     */
    public function getMechanic($mechanicId)
    {
        return Mechanic::find($mechanicId);
    }

    /**
     * @param $request
     */
    public function storeMechanic($request)
    {
        try {
        DB::beginTransaction();
        Mechanic::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            captureException($e);
        }
    }

    /**
     * @param $request
     * @param $mechanicId
     */
    public function updateMechanic($request, $mechanicId)
    {
        try {
            DB::beginTransaction();
        if ($request->email) {
            Mechanic::query()->where('id', $mechanicId)->update(['name' => $request->name, 'email' => $request->email]);
        }else {
            Mechanic::query()->where('id', $mechanicId)->update(['name' => $request->name]);
        }

        if ($request->garage) {
            Mechanic::query()->where('id', $mechanicId)->update(['garage_id' => $request->garage]);
        }
        DB::commit();
        }catch (\Exception $e){
            captureException($e);
            DB::rollBack();
        }
    }

    /**
     * @param $mechanicId
     */
    public function deleteMechanic($mechanicId)
    {
        Mechanic::find($mechanicId)->delete();
    }
}