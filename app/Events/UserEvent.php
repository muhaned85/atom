<?php
 namespace Atom\Events;

use Symfony\Component\HttpFoundation\JsonResponse;

 class UserEvent
 {
    public function userIsLogin(JsonResponse $response)
    {
        $a=1;
    }
    public function tryLogin($userName,$password)
    {
        $r=$userName;
    }
 }