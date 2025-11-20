<?php

namespace App\Http\Middleware;

use App\Constants\HttpHeaders;
use Closure;

class Localization
{

    public function handle($request, Closure $next)
    {
        if (auth('admin')->check() && $request->segment(1) == 'admin') {
            app()->setLocale('ar');
        } else {
            $lang = $request->header('X-Client-Language');
            if (in_array($lang, ['ar', 'en'])) {
                app()->setLocale($lang);
            }
        }
        return $next($request);
    }

}
