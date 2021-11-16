<?php

namespace App\Services\Mechanics;

use App\Models\Mechanic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MechanicService
{
    /**
     * @param $request
     * @param $mechanicId
     * @return bool
     */
    public function editProfile($request, $mechanicId): bool
    {

        try {
            DB::beginTransaction();
            $mechanic = $this->getMechanic($mechanicId);
            if (Hash::check($request->password, $mechanic->password)) {
                if (!$request->email) {
                    $mechanic->name = $request->name;
                    $mechanic->save();

                } else {
                    $mechanic->name = $request->name;
                    $mechanic->email = $request->email;
                    $mechanic->save();
                }
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
    public function updatePassword($request, $mechanicId): bool
    {
        try {
            DB::beginTransaction();
            $mechanic = $this->getMechanic($mechanicId);
            if (Hash::check($request->currentPassword, $mechanic->password)) {
                $mechanic->password = $request->newPassword;
                $mechanic->save();
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            captureException($e);
            DB::rollBack();
        }
        return false;
    }
}