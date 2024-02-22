<?php 

namespace Atom\Core\Concerns;
class BaseObject
{
    protected $prop = [];
    public function __set(string $name, mixed $value): void
    {
        $this->prop[$name] = $value;
    }
    public function __get(string $name)
    {
        if (!isset($this->prop[$name])) {
            return "";
        }
        return $this->prop[$name];
    }
}