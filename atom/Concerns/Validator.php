<?php

namespace Atom\Core\Concerns;

use Exception;

class Validator
{
    public function validate($name,$value, $validatros)
    {
        $v = explode("|", $validatros);
        foreach ($v as $oneValidator) {
            $parts = explode(":", $oneValidator);
            $class = "Atom\Core\Validator\\" . ucfirst($parts[0]);
            if (class_exists($class)) {
                $parts = array_slice($parts, 1);
                array_unshift($parts, $value);
                array_unshift($parts, $name);
                call_user_func_array([new $class, 'isValid'], $parts);
            } else {
                throw new Exception("Validator $class not Exist");
            }
        }
    }
}
