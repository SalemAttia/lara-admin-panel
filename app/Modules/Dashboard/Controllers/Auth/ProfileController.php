<?php

namespace App\Modules\Dashboard\Controllers\Auth;

use App\Modules\Core\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['AdminAuth', 'Roles']);
    }

    public function showProfile()
    {
        return view('Dashboard::profile');
    }
    public function profile(Request $request)
    {
        dd($request);
    }


}
