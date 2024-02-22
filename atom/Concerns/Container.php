<?php

namespace Atom\Core\Concerns;

use Exception;
use ReflectionClass;

class Container
{
    public  function build($className)
    {
        // Use ReflectionClass to analyze the class
        $class = new ReflectionClass($className);

        // Get the constructor of the class
        $constructor = $class->getConstructor();
        if (!$constructor) {
            // No constructor, just return a new instance
            return new $className;
        }

        // Get constructor parameters (dependencies)
        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            // Get the type of the parameter
            $dependency = $parameter->getType() && !$parameter->getType()->isBuiltin()
                ? $parameter->getType()->getName()
                : null;

            if ($dependency) {
                // Recursively resolve dependencies
                $dependencies[] = $this->build($dependency);
            } else {
                // Handle cases where dependencies cannot be resolved
                throw new Exception("Cannot resolve dependency for parameter: {$parameter->name}");
            }
        }

        // Create a new instance of the class with resolved dependencies
        return $class->newInstanceArgs($dependencies);
    }
}
