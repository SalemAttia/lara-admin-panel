<?php

namespace App\Modules\Admins\Middleware;
use App\Modules\Admins\Models\Admin;
use Closure;
use Illuminate\Support\Facades\Auth;


/**
 * Class ProtectAdmin
 * @package App\Modules\Admins\Middleware
 */
class ProtectAdmin
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next)
    {
        $admins = Admin::select('id')->where('role', 'super.admin')->get();
        $adminsIDs = [];
        foreach ($admins as $admin){
            $adminsIDs[] = $admin->id;
        }

        if($request->admin){
            if(Auth::guard('dashboard')->user()->role != 'super.admin' && in_array($request->admin->id,  $adminsIDs)){
                return redirect('/admin/not-have-access');
            }
        }
        return $next($request);
    }
}
