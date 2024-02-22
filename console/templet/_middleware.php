<?php

namespace Atom\Middleware;

use Closure;
use Exception;

class T_Name
{

    public function handel($request, Closure $next)
    {
        return  $next($request);
    }
}
