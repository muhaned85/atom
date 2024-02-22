<?php 
namespace Atom\Core\Concerns;

use Exception;

class Services
{
    public $model;
    public function __call($method, $parametrs)
    {
    if (!method_exists($this->model,$method))
    {
        throw new Exception("$method method dos not exists ");
    }
        return $this->model->$method(...$parametrs);
    }
    public function __set($name, $value)
    {
        $this->model->$name = $value;
    }
}