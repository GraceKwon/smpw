<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Stevebauman\Location\Facades\Location;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if(getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';


        $checkIp = $_SERVER['REMOTE_ADDR'];
//        $checkIp = '211.234.188.150';
//        $checkIp = '196.201.141.224';
        $getLocation = Location::get($checkIp);
        \Log::info($ipaddress);
        \Log::info('=========OTHER===========');
        \Log::info($checkIp);
        \Log::info('======IP===========');
        \Log::info($getLocation);

        if ($getLocation->countryCode === 'KR') {
            $locale = 'ko';
        } else {
            $locale = 'en';
        }

//        if ($request->expectsJson()) {
//            $locale = $request->header('X-Language');
//        } else {
//            $locale = $request->cookie('X-Language');
//        }

        // When there is wrong locale set to default english language
        if (!in_array($locale, ['en', 'ko'])) {
            $locale = 'en';
        }

        App::setLocale($locale);
        return $next($request);
    }
}
