<?php

namespace App\Services\Mechanics;

use App\Models\Mechanic;
use App\Services\ResponseService;
use Illuminate\Support\Facades\Hash;

class MechanicService
{
    /**
     * @param $request
     * @param $mechanicId
     * @return ResponseService
     */
    public function editProfile($request, $mechanicId): ResponseService
    {
        try {
            $mechanic = $this->getMechanic($mechanicId);

            if (!Hash::check($request->password, $mechanic->password)) {
                return ResponseService::response(false, 'Wrong password');
            }
            $mechanic->name = $request->name;
            $mechanic->email = $request->email;
            $mechanic->save();

            return ResponseService::response(true, 'Profile successfully updated');

        } catch (\Exception $e) {
            captureException($e);

            return ResponseService::response(false, 'Something went wrong');
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getMechanic($id)
    {
        return Mechanic::find($id);
    }

    /**
     * @param $request
     * @param $mechanicId
     * @return ResponseService
     */
    public function updatePassword($request, $mechanicId): ResponseService
    {
        try {
            $mechanic = $this->getMechanic($mechanicId);
            if (!Hash::check($request->currentPassword, $mechanic->password)) {
                return ResponseService::response(false, 'Wrong password');
            }
            $mechanic->password = $request->password;
            $mechanic->save();
            return ResponseService::response(true, 'You successfully update your password');

        } catch (\Exception $e) {
            captureException($e);
            return ResponseService::response(false, 'Something went wrong');
        }
    }
}