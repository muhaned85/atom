<?php

namespace Atom\Middleware;

use Closure;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class Token
{

   public function handel($request, Closure $next)
   {

      $token = $this->bearerToken($request);;
      if (empty($token) || $token !="kgklmelknlkevlkevlkerlkr" )
      {
        $response = new JsonResponse(['status'=>'Error','msg'=>'invalid token']);
        return  $response ; 
      }
      return  $next($request);
   }

   public function bearerToken($request)
   {
      $header = $request->headers->get('Authorization', '');

      $position = strrpos($header, 'Bearer ');

      if ($position !== false) {
         $header = substr($header, $position + 7);

         return str_contains($header, ',') ? strstr($header, ',', true) : $header;
      }
   }
}
