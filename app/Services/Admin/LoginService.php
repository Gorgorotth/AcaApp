<?php

namespace App\Services\Admin;

use App\Services\ResponseService;

class LoginService
{
    /**
     * @return bool
     */
    public function checkIfLoggedAsAdmin(): bool
    {
        if (auth('admin')->user()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $request
     * @return ResponseService
     */
    public function loginAdmin($request): ResponseService
    {
        if (!auth('admin')->attempt($request->except('_token'))) {
            return ResponseService::response(false, 'Wrong email or password');
        } else {
            return ResponseService::response(true, 'Logged in as Admin');
        }
    }
}