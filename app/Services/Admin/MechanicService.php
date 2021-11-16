<?php

namespace App\Services\Admin;

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
     * @param $model
     * @return mixed
     */
    public function dashboard($request, $model)
    {
        $data = $model::query();
        if (!request()->sortByCreatedDate) {
            request()->sortByCreatedDate = 1;
        } else {
            request()->sortByCreatedDate = 0;
        }

        if ($request) {
            $data->filter(request(['search']));
        }

        if (request()->sortByCreatedDate == 1) {
            $data = $data->orderByDesc('created_at');
        } else {
            if (request()->sortByCreatedDate == 0) {
                $data = $data->orderBy('created_at');
            } else {
                $data = $data->latest();
            }
        }
        return $data->paginate(6);
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
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            captureException($e);
        }
        return false;
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
                Mechanic::query()->where('id', $mechanicId)->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
            } else {
                Mechanic::query()->where('id', $mechanicId)->update(['name' => $request->name]);
            }

            if ($request->garage) {
                Mechanic::query()->where('id', $mechanicId)->update(['garage_id' => $request->garage]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            captureException($e);
            DB::rollBack();
        }
        return false;
    }

    /**
     * @param $mechanicId
     */
    public function deleteMechanic($mechanicId)
    {
        try {
            return Mechanic::query()->find($mechanicId)->delete();
        } catch (\Exception $e) {
            captureException($e);
        }
        return false;
    }
}