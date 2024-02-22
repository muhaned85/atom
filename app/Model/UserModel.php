<?php

namespace  Atom\Model;

use Atom\Core\Concerns\Model;

class UserModel extends Model
{
    public $tableName = "users";
    public $primaryKey='user_id';
    public $action = '';
    public $safe = ['email', 'username', 'password', 'phone','token'];

    public function getToken()
    {

    }
   
    public function rules()
    {
        return
            [
                'register' => [
                    'email' => 'required|email',
                    'username' => 'required',
                    'password' => 'required|min:8',
                ],
                'login' => [
                    'email' => 'required|email',
                    'password' => 'required',
                ],
            ];
    }
}
