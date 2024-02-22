<?php

namespace  Atom\Core\Validator;

use Exception;

class Required
{

    public function isValid($name,$data)
    {
        if (empty($data)) {
            throw new Exception("$name is Required");
        }
    }
}
