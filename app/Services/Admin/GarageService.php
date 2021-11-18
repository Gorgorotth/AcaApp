<?php

namespace App\Services\Admin;

use App\Models\Garage;
use App\Models\GarageEmail;
use App\Models\Mechanic;
use App\Services\ResponseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class GarageService
{
    /**
     * @param $request
     * @return ResponseService
     */
    public function storeGarage($request): ResponseService
    {
        try {
            DB::beginTransaction();
            $garage = Garage::query()->create([
                'name' => $request->name,
                'address' => $request->address,
                'hourly_rate' => $request->hourlyPrice
            ]);
            if ($emails = $request->addEmailToGarage) {
                foreach ($emails as $email) {
                    $garage->emails()->create([
                        'email' => $email,
                    ]);
                }
            }
            if ($mechanics = $request->mechanics) {
                foreach ($mechanics as $mechanicId) {
                    Mechanic::query()->where('id', $mechanicId)->update([
                        'garage_id' => $garage->id
                    ]);
                }
            }
            DB::commit();
            return ResponseService::response(true, 'Garage Created');
        } catch (\Exception $e) {
            captureException($e);
            DB::rollBack();
        }
        return ResponseService::response(false, 'Something went wrong');
    }

    /**
     * @param $garageId
     * @return mixed
     */
    public function getEmailsForGarage($garageId)
    {
        return $this->getGarage($garageId)->emails;
    }

    /**
     * @param $garageId
     * @return mixed
     */
    public function getGarage($garageId)
    {
        return Garage::find($garageId);
    }

    /**
     * @param $garageId
     * @return mixed
     */
    public function getMechanicsForGarage($garageId)
    {
        return $this->getGarage($garageId)->mechanics;
    }

    /**
     * @param $garageId
     * @return GarageEmail[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function getDeletedEmailsForGarage($garageId)
    {
        return GarageEmail::onlyTrashed()->where('garage_id', $garageId)->get();
    }

    /**
     * @param $emailId
     * @return ResponseService
     */
    public function deleteEmail($emailId): ResponseService
    {
        try {
            GarageEmail::find($emailId)->delete();
            return ResponseService::response(true, 'Email is deleted');
        } catch (\Exception $e) {
            captureException($e);
        }
        return ResponseService::response(false, 'Something went wrong');
    }

    /**
     * @param $emailId
     * @return ResponseService
     */
    public function restoreEmail($emailId): ResponseService
    {
        try {
            GarageEmail::onlyTrashed()->find($emailId)->restore();
            return ResponseService::response(true, 'Email restored');
        } catch (\Exception $e) {
            captureException($e);
        }
        return ResponseService::response(false, 'Something went wrong');
    }

    /**
     * @param $mechanicId
     * @return ResponseService
     */
    public function removeMechanic($mechanicId): ResponseService
    {
        try {
            Mechanic::query()->where('id', $mechanicId)->update([
                'garage_id' => null
            ]);
            return ResponseService::response(true, 'Mechanic is removed');
        } catch (\Exception $e) {
            captureException($e);
        }
        return ResponseService::response(false, 'Something went wrong');
    }

    /**
     * @param $request
     * @param $garageId
     * @return ResponseService
     */
    public function updateGarage($request, $garageId): ResponseService
    {
        try {
            DB::beginTransaction();
            $this->getGarage($garageId)->update([
                'name' => $request->name,
                'address' => $request->address,
                'hourly_rate' => $request->hourlyRate
            ]);
            if ($mechanics = $request->mechanics) {
                foreach ($mechanics as $i => $mechanicId) {
                    Mechanic::query()->where('id', $mechanicId)->update([
                        'garage_id' => $garageId
                    ]);
                }
            }
            if ($emails = $request->addEmailToGarage) {
                foreach ($emails as $i => $email) {
                    $this->getGarage($garageId)->emails()->create([
                        'email' => $email,
                    ]);
                }
            }
            DB::commit();
            return ResponseService::response(true, 'Update Successful');
        } catch (\Exception $e) {
            captureException($e);
            DB::rollBack();
        }
        return ResponseService::response(false, 'Something went wrong');
    }

    /**
     * @return Garage[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllGarages()
    {
        return Garage::all();
    }

    /**
     * @param $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function garageDashboard($request): LengthAwarePaginator
    {
        if ($request->search) {
            if ($request->sortByCreatedDate == 1) {
                $invoices = Garage::query()->filter(['search' => $request->search])->orderByDesc('created_at');
            } else {
                $invoices = Garage::query()->filter(['search' => $request->search])->orderBy('created_at');
            }
        } else {
            if ($request->sortByCreatedDate == 1) {
                $invoices = Garage::query()->orderByDesc('created_at');
            } else {
                $invoices = Garage::query()->orderBy('created_at');
            }
        }
        return $invoices->paginate(6);
    }

    /**
     * @param $garageId
     * @return ResponseService
     */
    public function deleteGarage($garageId): ResponseService
    {
        try {
            DB::beginTransaction();
            $garage = $this->getGarage($garageId);
            $garage->delete();
            $garage->mechanics()->update([
                'garage_id' => null
            ]);
            $garage->emails()->delete();
            DB::commit();
            return ResponseService::response(true, 'Garage deleted successfully');
        } catch (\Exception $e) {
            captureException($e);
            DB::rollBack();
        }
        return ResponseService::response(false, 'Something went wrong');
    }
}