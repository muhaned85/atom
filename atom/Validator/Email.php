<?php

namespace Atom\Core\Validator;

use Exception;

class Email
{

    public function isValid($name,$data)
    {
        if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
           return true;
        }
        
        throw new Exception(" $name must be is email adress");
      
    }
}
