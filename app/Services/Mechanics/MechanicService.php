<?php

namespace App\Services\Mechanics;

use App\Http\Requests\EditMechanicProfileRequest;
use App\Models\Mechanic;
use Illuminate\Support\Facades\Hash;

class MechanicService
{
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
     * @return bool
     */
    public function editProfile($request, $mechanicId): bool
    {
        $mechanic = $this->getMechanic($mechanicId);
        if (!Hash::check($request->password, $mechanic->password)) {
            return false;
        } elseif (!$request->email) {
            $mechanic->name = $request->name;
            $mechanic->save();
            return true;
        } else {
            $mechanic->name = $request->name;
            $mechanic->email = $request->email;
            $mechanic->save();
            return true;
        }
    }

    /**
     * @param $request
     * @param $mechanicId
     * @return bool
     */
    public function updatePassword($request, $mechanicId): bool
    {

        $mechanic = $this->getMechanic($mechanicId);
        if (!Hash::check($request->currentPassword, $mechanic->password)){
            return false;
        } else{
            $mechanic->password = $request->newPassword;
            $mechanic->save();
            return true;
        }
    }
}