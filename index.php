<?php
include "vendor/autoload.php";
include "config.php";
use Atom\Core\App;
use Symfony\Component\HttpFoundation\Request;

//include 'micro.php';
$request= Request::createFromGlobals();
$request ->getMethod();
 

$app=new App($request);
 
$app->callDynamicEndPoint();