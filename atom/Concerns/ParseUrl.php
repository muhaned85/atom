<?php

namespace Atom\Core\Concerns;

class ParseUrl
{
    private $_url;
    public function __construct(string $url)
    {
        $this->_url = $url;
    }
    public function parseToConrollerAction()
    {
        $parts = explode('/', trim($this->_url, "/"));
        $controller = array_shift($parts);
        $action = array_shift($parts);
        $action= str_replace("%20", "",  $action);
        return [
            $controller = !empty($controller) ? ucfirst(strtolower($controller)) : "Defualt",
            $action = !empty($action) ?trim( ucfirst(strtolower($action))) : "Index",
            $parts
        ];
    }
}
