<?php 
namespace Atom\Core\Concerns;

use Atom\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;

trait Requests
{
    public function dispatch($request = null)
    {
        [$Http_Method, $pathInfo] = $this->parseIncomingRequest($this->request);
        [$controller, $action, $parameters] = (new ParseUrl($pathInfo))->parseToConrollerAction();
        $controllerClass  = "Atom\\Controller\\$controller"."Controller";
        if (!class_exists($controllerClass)) {
            throw new NotFoundHttpException();
        }
        return [$controllerClass, $Http_Method . $action, $parameters];
    }
    
    protected function parseIncomingRequest($request)
    {
        return [strtolower($request->getMethod()), '/' . trim($request->getPathInfo(), '/')];
    }
    private function sendResponse($response)
    {
        if ($response instanceof JsonResponse) {
            $response->send();
        } else {
            echo (string) $response;
        }
        exit;
    }
  
}