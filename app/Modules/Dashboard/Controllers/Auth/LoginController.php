<?php

namespace App\Modules\Dashboard\Controllers\Auth;

use App\Modules\Core\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';
    protected $redirectPath = '/dashboard/login';

    public function __construct()
    {
        if(request()->redirectTo){
            $this->redirectTo = request()->redirectTo;
        }
        $this->middleware('guest:dashboard')->except('logout');
    }

    public function showLoginForm()
    {
        return view('Dashboard::login');
    }

    public function login(Request $request){
         $this->validate($request, [
            'email' => 'required|email|exists:admins',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('dashboard')->attempt(
            ['email' => $request->email, 'password' => $request->password],
            $request->remember
        )){
            \Event::fire('admin.loginRedirect', [$this]);
            return redirect()->intended(url($this->redirectTo));
        }
        return redirect()->back()->withInput($request->only(['email', 'remember']));
    }

    public function logout(Request $request)
    {
        Auth::guard('dashboard')->logout();

        $request->session()->invalidate();

        return redirect($this->redirectPath);
    }

    public function setRedirect($path){
        $this->redirectTo = $path;
    }


}
