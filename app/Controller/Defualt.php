<?php
 
namespace  Atom\Controller;
 

class Defualt extends BaseController
{
    public $middleware=[];
    public $route_middleware = [];

    public function getIndex()
    {
        return $this->send(['action'=>'index']);
    }
}
