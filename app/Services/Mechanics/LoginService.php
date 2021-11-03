<?php

namespace App\Services\Mechanics;

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
     * @return bool
     */
    public function store($request): bool
    {
        if (auth()->attempt($request->except('_token'))) {
            return true;
        } else {
            return false;
        }
    }
}