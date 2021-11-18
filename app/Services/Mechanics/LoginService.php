<?php

namespace App\Services\Mechanics;

use App\Services\ResponseService;

class LoginService
{
    /**
     * @return bool
     */
    public function checkIfLoggedIn(): bool
    {
        if (auth()->user()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $request
     * @return ResponseService
     */
    public function store($request): ResponseService
    {
        if (auth()->attempt($request->except('_token'))) {
            return ResponseService::response(true, 'Logged in successfully');
        } else {
            return ResponseService::response(false, 'Wrong email or password');
        }
    }
}