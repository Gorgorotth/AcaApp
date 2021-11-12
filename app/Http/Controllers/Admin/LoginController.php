<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginStoreRequest;
use App\Services\Admin\LoginService;
use Illuminate\Http\Request;

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
        if ($this->loginService->checkIfLoggedAsAdmin()) {
            return redirect(route('admin.dashboard'));
        } else {
            return view('admin.login.index');
        }
    }

    /**
     * @param LoginStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(
        LoginStoreRequest $request
    ) {
        if ($this->loginService->loginAdmin($request) == false) {
            return back()->with('error', 'Wrong email or password');
        } else {
            return redirect(route('admin.dashboard'))->with('success', 'Logged in as Admin');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public
    function destroy()
    {
        auth('admin')->logout();
        return redirect(route('home'))->with('success', 'Logged out successfully');
    }
}
