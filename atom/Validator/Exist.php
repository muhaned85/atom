<?php

namespace Atom\Core\Validator;

use Exception;

class Exist
{

    public function isValid($name,$data,$model)
    {
        $user = $model->where($name, $data)->find_one();

        if ($user) {
            throw new Exception(" $data is exist");
        }  
      
    }
}
