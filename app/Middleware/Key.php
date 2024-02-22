<?php

namespace Atom\Middleware;

use Closure;
use Exception;

class Key
{

    public function handel($request, Closure $next)
    {
        return  $next($request);
    }
}
