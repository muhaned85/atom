<?php

namespace  Atom\Controller;

use Atom\Model\QueryBuilder;;

class Atom extends BaseController
{
    public function getindex()
    {
        return $this->send('read api document ');
    }
}
