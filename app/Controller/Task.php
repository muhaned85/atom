<?php
 
namespace  Atom\Controller;
 

class Task extends BaseController
{
    public $middleware=[];
    public $route_middleware = [];

    public function getIndex()
    {
        return $this->send(['action'=>'index']);
    }
}
