<?php

namespace App\Services\Admin;

use App\Models\Garage;
use App\Models\GarageEmail;
use App\Models\Mechanic;

class GarageService
{
    public function storeGarage($request)
    {
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

        if ($mechanics = $request->mechanics){
            foreach ($mechanics as $mechanicId){
                Mechanic::query()->where('id', $mechanicId)->update([
                    'garage_id' => $garage->id
                ]);
            }
        }
    }
}