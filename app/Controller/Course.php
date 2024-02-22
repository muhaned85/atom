<?php
namespace Atom\Controller;
use Symfony\Component\HttpFoundation\Request;

class Course extends BaseController
{
    public function getone($id)
    {
        return $this->send($id);
    }
    public function postone($id)
    {
        return $this->send($this->allParms);
    }
}
