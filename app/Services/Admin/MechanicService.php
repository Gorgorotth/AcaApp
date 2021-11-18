<?php

namespace App\Services\Admin;

use App\Models\Mechanic;
use App\Services\ResponseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class MechanicService
{
    /**
     * @return Collection
     */
    public function getUnemployedMechanics(): Collection
    {
        return Mechanic::query()->whereNull('garage_id')->get();
    }

    /**
     * @return Collection
     */
    public function getAllMechanics(): Collection
    {
        return Mechanic::all();
    }

    /**
     * @param $mechanicId
     * @return ?Mechanic
     */
    public function getMechanic($mechanicId): ?Mechanic
    {
        return Mechanic::find($mechanicId);
    }

    /**
     * @param $request
     * @return LengthAwarePaginator
     */
    public function mechanicDashboard($request): LengthAwarePaginator
    {
        if ($request->search) {
            if ($request->sortByCreatedDate == 1) {
                $invoices = Mechanic::query()->filter(['search' => $request->search])->orderByDesc('created_at');
            } else {
                $invoices = Mechanic::query()->filter(['search' => $request->search])->orderBy('created_at');
            }
        } else {
            if ($request->sortByCreatedDate == 1) {
                $invoices = Mechanic::query()->orderByDesc('created_at');
            } else {
                $invoices = Mechanic::query()->orderBy('created_at');
            }
        }
        return $invoices->paginate(6);
    }

    /**
     * @param $request
     * @return ResponseService
     */
    public function storeMechanic($request): ResponseService
    {
        try {
            Mechanic::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            return ResponseService::response(true, 'You created a mechanic');
        } catch (\Exception $e) {
            captureException($e);
        }
        return ResponseService::response(false, 'Something went wrong');
    }

    /**
     * @param $request
     * @param $mechanicId
     * @return ResponseService
     */
    public function updateMechanic($request, $mechanicId): ResponseService
    {
        try {
            Mechanic::query()->where('id', $mechanicId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'garage_id' => $request->garageId
            ]);
            return ResponseService::response(true, 'Mechanic is deleted');
        } catch (\Exception $e) {
            captureException($e);
        }
        return ResponseService::response(false, 'Something went wrong');
    }

    /**
     * @param $mechanicId
     * @return ResponseService
     */
    public function deleteMechanic($mechanicId): ResponseService
    {
        try {
            Mechanic::query()->find($mechanicId)->delete();
            return ResponseService::response(true, 'Mechanic is deleted');
        } catch (\Exception $e) {
            captureException($e);
        }
        return ResponseService::response(false, 'Something went wrong');
    }
}