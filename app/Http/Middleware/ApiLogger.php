<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
class ApiLogger
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
        return $next($request);
    }

    public function terminate(Request $request, $response) {

        //log kayıtları

        if (env('API_LOGGER', true)) {
            $startTime = LARAVEL_START;
            $endTime = microtime(true);
            $log = '[' . date('Y-m-d H:i:s') . ']';
            $log .= '[' . $request->ip() . ']';
            $log .= '[' . $request->method() . ']';
            $log .= '[' . $request->fullUrl() . ']';

            //belirlenen dosyadaki log dosyasına  kayıt

            //DirectorySeparator= slaş    
            $fileName = 'api_logger_' . date('Y-m-d') . '.log';
            File::append(storage_path('logs' . DIRECTORY_SEPARATOR .  $fileName), $log . "\n");
        }




         

        /*
        //hazır olan log dosyasına kayıt 
        //Log::info($log);  
        */


        
    }
}
