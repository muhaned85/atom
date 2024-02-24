<?php
namespace Atom\Core\Concerns;

use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends BaseObject
{
use Actions;

public $middleware = [];
public $events=[
    'BeforAction'=>[],
    'AftterAction'=>[],
];
public $route_middleware = [];
private $_rules = [];
public function send($data)
{
    $response = new JsonResponse($data);
    return  $response;
}
public function applayRules($rules)
{
    
    foreach ($rules as $field => $rule) {

        $validator = new Validator;
        $validator->validate($field, $this->{$field}, $rule);
    }
}
}