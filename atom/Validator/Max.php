<?php

namespace Atom\Core\Validator;

use Exception;

class Max
{

    public function isValid($name,$data,$condation)
    {
        if (is_string($data)) {
            if (strlen($data) > intval($condation))
            {
                throw new Exception("max len of $name is $condation");
            }
        }
        if (is_numeric($data)) {
        if ($data > intval($condation))
        throw new Exception("max len of $name is $condation");
        }
    }
}
