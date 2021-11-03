<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginStoreRequest;
use App\Services\Mechanics\LoginService;

class LoginController extends Controller
{
    public $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index()
    {
        if ($this->loginService->checkIfLoggedIn() == false) {
            return view('mechanic.login.index');
        } else {
            return redirect(route('mechanic.dashboard'));
        }
    }

    public function store(LoginStoreRequest $request)
    {
        if ($this->loginService->store($request)) {
            return redirect(route('mechanic.dashboard'))->with('success', 'Logged in successfully');
        } else {
            return back()->with('password', 'Wrong email or password');
        }
    }

    public function destroy()
    {
        auth()->logout();
        return redirect(route('home'))->with('success', 'Logged out');
    }
}
