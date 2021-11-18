<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginStoreRequest;
use App\Services\Mechanics\LoginService;

class LoginController extends Controller
{
    /**
     * @var LoginService
     */
    public $loginService;

    /**
     * @param LoginService $loginService
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        if ($this->loginService->checkIfLoggedIn() == false) {
            return view('mechanic.login.index');
        } else {
            return redirect(route('mechanic.dashboard'));
        }
    }

    /**
     * @param LoginStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(LoginStoreRequest $request)
    {
        $user = $this->loginService->store($request);
        if ($user->getSuccess()) {
            return redirect(route('mechanic.dashboard'))->with('success', $user->getMessage());
        } else {
            return back()->with('password', $user->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy()
    {
        auth()->logout();
        return redirect(route('home'))->with('success', 'Logged out');
    }
}
