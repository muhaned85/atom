<?php

namespace  Atom\Controller;

use Atom\AppLogic\UserService;
use Atom\Core\Concerns\BaseController;
 

class T_Name extends BaseController
{
    public $middleware=[];
    public $route_middleware = [];

    public function getIndex()
    {
        return $this->send(['action'=>'index']);
    }
}
