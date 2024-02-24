<?php
 
namespace  Atom\Controller;

use Atom\Core\Concerns\BaseController;

class Defualt extends BaseController
{
    public $middleware=[];
    public $route_middleware = [];

    public function getIndex()
    {
        return $this->send(['action'=>'index']);
    }
}
