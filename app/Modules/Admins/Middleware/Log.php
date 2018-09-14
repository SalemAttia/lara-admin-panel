<?php

namespace App\Modules\Admins\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;


class Log
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ProwserDetalis = $_SERVER['HTTP_USER_AGENT'];
        $adminId = Auth::guard('dashboard')->user()->id;
        $ip = "";
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if(!empty($_SERVER['REMOTE_ADDR']))
            $ip = $_SERVER['REMOTE_ADDR'];
        else{
            $ip = 'UNKNOWN';
        }
        $headers = $request;
        $method = $headers->method();
        if ($method != "GET"){
            $requestUri = $headers->getPathInfo();
            $data = [
                'action' => $method,
                'Url' => $requestUri,
                'user_id' => $adminId,
                'ProwserDetalis' => $ProwserDetalis,
                'ip' => $ip
            ];
            $log = \App\Modules\Log\Models\Log::create($data);

        }


        return $next($request);
    }
}
