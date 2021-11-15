<?php

namespace App\Services\Admin;

use App\Models\Garage;
use App\Models\GarageEmail;
use App\Models\Mechanic;
use Illuminate\Support\Facades\DB;

class GarageService
{
    /**
     * @param $request
     */
    public function storeGarage($request)
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
                    GarageEmail::query()->create([
                        'email' => $email,
                        'garage_id' => $garage->id
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
        }catch (\Exception $e){
            captureException($e);
            DB::rollBack();
        }
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
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getEmailsForGarage($garageId)
    {
        return GarageEmail::query()->where('garage_id', $garageId)->get();
    }

    /**
     * @param $garageId
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getMechanicsForGarage($garageId)
    {
        return Mechanic::query()->where('garage_id', $garageId)->get();
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
     */
    public function deleteEmail($emailId)
    {
        GarageEmail::find($emailId)->delete();
    }

    /**
     * @param $emailId
     */
    public function restoreEmail($emailId)
    {
        GarageEmail::onlyTrashed()->find($emailId)->restore();
    }

    /**
     * @param $mechanicId
     */
    public function removeMechanic($mechanicId)
    {
        try {
            DB::beginTransaction();
            Mechanic::query()->where('id', $mechanicId)->update([
                'garage_id' => null
            ]);
            DB::commit();
        }catch (\Exception $e){
            captureException($e);
            DB::rollBack();
        }
    }

    /**
     * @param $request
     * @param $garageId
     */
    public function updateGarage($request, $garageId)
    {
        try {
            DB::beginTransaction();
            Garage::query()->where('id', $garageId)->update([
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
                    GarageEmail::query()->create([
                        'email' => $email,
                        'garage_id' => $garageId
                    ]);
                }
            }
            DB::commit();
        }catch (\Exception $e){
            captureException($e);
            DB::rollBack();
        }
    }

    /**
     * @return Garage[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllGarages()
    {
       return Garage::all();
    }

    /**
     * @param $garageId
     */
    public function deleteGarage($garageId)
    {
        try {
            DB::beginTransaction();
            Garage::query()->firstWhere('id', $garageId)->delete();
            Mechanic::query()->where('garage_id', $garageId)->update([
                'garage_id' => null
            ]);
            GarageEmail::query()->where('garage_id', $garageId)->delete();
            DB::commit();
        }catch (\Exception $e){
            captureException($e);
            DB::rollBack();
        }
    }

}