<?php

namespace  Atom\Controller;

use Atom\AppLogic\UserService;
use Atom\Core\Concerns\BaseController;
use Atom\Model\UserModel;

class UserController extends BaseController
{
    public $middleware = ['token'];
    public $route_middleware = [];
    private $_service;
    public $events=[
        'beforAction'=>[

        ],
        'AftterAction'=>[
            'register'=>'NotifcationNewUser,send_sms',
            'postLogin'=>'lastLogin',
        ],
    ];
    public function __construct(UserService $service)
    {
        $this->_service = $service;
    }
    public function getIndex()
    {
        return $this->send(['action' => 'index']);
    }
    public function postRegister()
    {

        $this->_service->action = 'register';
        $this->_service->loadAndValidation($this);
        $response = $this->_service->createUser();
        return $this->send($response);
    }
    public function postLogin()
    {
        $this->_service->action = 'login';
        $this->_service->loadAndValidation($this);
        return $this->send($this->_service->login());
    }
}
