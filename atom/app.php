<?php

namespace Atom\Core;

use Atom\Core\Concerns\Container;
use Atom\Core\Concerns\RegistersExceptionHandlers;
use Atom\Core\Concerns\Requests;
use Exception;
use ReflectionClass;
use Symfony\Component\HttpFoundation\Request;


class  App extends Container
{
    use Requests;
    public $request;
    public $basePath;
    public function __construct(Request $request)
    {
        $this->basePath = __DIR__;
        $this->request =  $request;
        (new RegistersExceptionHandlers)->registerErrorHandling();
    }
    public function callDynamicEndPoint()
    {
        try {
            [$controllerClass, $action, $parameters] = $this->dispatch($this->request);
            $response = $this->callAction($controllerClass, $action, $parameters);
            $this->sendResponse($response);
        } catch (Exception $e) {
            throw new Exception($e->getmessage());
        }
    }

    private function createController($class)
    {
        $controller = $this->build($class);
        $requsetData =  array_merge($this->request->request->all(), $this->request->query->all());
        // $obj->allParms = [$this->request->query->all(), $this->request->request->all()];
        foreach ($requsetData as $key => $value) {
            $controller->$key = $value;
        }
        $controller->content = $this->request->getContent();
        return $controller;
    }
    private function callMiddleWare($controller)
    {

        $response = null;
        $middlewareStack = $controller->middleware;
        foreach ($middlewareStack as $middleware) {
            $m = "Atom\Middleware\\" . $middleware;
            $middleware = new $m;

            $response = $middleware->handel($this->request, function ($x) {
                return null;
            });
        }
        return $response;
    }
    private function raiseAfterEvent($controller, $action, $response)
    {
        $AftterActionEvents  = $controller->events['AftterAction'][$action] ?? null;
        if ($AftterActionEvents) {
            $event = $this->createEvent(get_class($controller));
            foreach (explode(",", $AftterActionEvents) as $callEvent) {
                $event->$callEvent($response);
            }
        }
    }
    private function raiseBeforeEvent($controller, $action, $parameters)
    {
        $beforeActionEvents  = $controller->events['beforAction'][$action] ?? null;
        if ($beforeActionEvents) {
            $event = $this->createEvent(get_class($controller));
            foreach (explode(",", $beforeActionEvents) as $callEvent) {
                call_user_func_array([$event, $callEvent], $parameters);
            }
        }
    }
    private function createEvent($className)
    {
        $eventclass = "Atom\Events\\" . trim(strrchr($className, '\\'), '\\') . "Event";
        return new $eventclass;
    }

    public function callAction($controllerClass, $action, $parameters)
    {
        $response = null;
        $controller = $this->createController($controllerClass);
        $response = $this->callMiddleWare($controller);

        if ($response == null) {
            $this->raiseBeforeEvent($controller, $action, $parameters);
            $response = $this->runAction($controller, $action, $parameters);
        }
        $this->raiseAfterEvent($controller, $action, $response);
        return $response;
    }


    private function runAction($class, $method, $parameters)
    {

        $parm_count = $parameters == "" ? 0 : count($parameters);
        $this->methodExist($class, $method, $parm_count);
        // $reflectionMethod->invokeArgs($class,$method);
        return  call_user_func_array([$class, $method], $parameters);
    }
    private function   methodExist($class, $name, $parm_count)
    {
        $reflection = new ReflectionClass($class);
        foreach ($reflection->getMethods() as $method) {
            if ($method->getName() === $name) {
                if (count($method->getParameters()) == $parm_count) {
                    return;
                } else {
                    throw new Exception("Method $name has " . count($method->getParameters()) . " Parameters  Not $parm_count Parameters");
                }
            }
        }
        throw new Exception("Method $name Not Found");
    }
   
}
