<?php
 namespace Atom\Events;

use Symfony\Component\HttpFoundation\JsonResponse;

 class UserControllerEvent
 {
   public function loginTime(JsonResponse $response)
   {
    $a=$response;
   }
 }