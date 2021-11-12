<?php

namespace App\Services\Admin;

class LoginService
{
    /**
     * @return bool
     */
    public function checkIfLoggedAsAdmin(): bool
    {
        if (auth('admin')->user()){
            return true;
        }else {
            return false;
        }
    }

    /**
     * @param $request
     * @return bool
     */
    public function loginAdmin($request): bool
    {
        if (!auth('admin')->attempt($request->except('_token'))) {
            return false;
            }else {
                return true;
            }
    }
}