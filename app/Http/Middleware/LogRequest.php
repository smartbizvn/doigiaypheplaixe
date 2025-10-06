<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;


class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $req, Closure $next)
    {
        try {
            $ip = $req->ip();
            $storeLog  = config('constants.store_log');
            $loginId = 'no_login';
            if (Auth::check()) {
                $loginId = "***". Auth::user()->id ."***";
            }
            $params = $req->except('password', 'repassword', '_token');
            if($storeLog == true){
                Log::channel('log_info_request')->info('Info', ['ip' => $ip , 'loginId' => $loginId, 'url' => request()->path(), 'params' => json_encode($params, JSON_UNESCAPED_UNICODE)]);
            }
        } catch (\Exception $e) {
            Log::channel('log_error_request')->info('Error', ['browserInfo' => $req->header('User-Agent') ,'ip' => $ip, 'loginId' => $loginId, 'url' => request()->path(), 'params' => json_encode($params, JSON_UNESCAPED_UNICODE), 'error_msg' => $e->getMessage()]);
        }
        return $next($req);
    }
}
