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
     * @param $request
     * @return LengthAwarePaginator
     */
    public function mechanicDashboard($request): LengthAwarePaginator
    {
        $mechanics = Mechanic::query();

        if ($request->search) {
            $mechanics->filter(['search' => $request->search]);
        }

        if ($request->sortByCreatedDate == Mechanic::SORT_DESC) {
            $mechanics->orderByDesc('created_at');
        } else {
            $mechanics->orderBy('created_at');
        }

        return $mechanics->paginate(6);
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
            return ResponseService::response(true, 'Mechanic updated');
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
            $this->getMechanic($mechanicId)->delete();
            return ResponseService::response(true, 'Mechanic is deleted');
        } catch (\Exception $e) {
            captureException($e);
        }
        return ResponseService::response(false, 'Something went wrong');
    }

    /**
     * @param $mechanicId
     * @return ?Mechanic
     */
    public function getMechanic($mechanicId): ?Mechanic
    {
        return Mechanic::find($mechanicId);
    }
}