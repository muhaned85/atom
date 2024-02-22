<?php

namespace Atom\AppLogic;

use Atom\Core\Concerns\Services;
use Atom\Model\UserModel;
use Exception;

class  UserService extends Services
{
    public $model;
    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    public function Login()
    {
        $user = $this->model->where_equal('email', $this->model->email)
            ->where_equal('password', $this->model->password)->find_one();
    
        if (!$user) return false;
        $user->set('token', $this->generateToken());
        $user->save();
        return $user->as_array();
    }
    private function generateToken()
    {
        return bin2hex(random_bytes(64));
    }

    public function createUser()
    {
        $this->model->token = $this->generateToken();
        return  $this->model->save();
    }
  
}
