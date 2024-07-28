<?php
namespace App\Core;
use ReflectionClass;
use ReflectionMethod;
use App\Config\ProviderServices;

class Route {
    private $routes = [];
    private $providerServices;

    public function __construct()
    {
        $this->providerServices = ProviderServices::getInstance();
    }

    public function get($uri, $controllerAction) {
        $this->routes['GET'][$uri] = $controllerAction;
    }

    public function post($uri, $controllerAction) {
        $this->routes['POST'][$uri] = $controllerAction;
    }

    // public function dispatch() {
    //     $method = $_SERVER['REQUEST_METHOD'];
    //     $uri = trim($_SERVER['REQUEST_URI'], '/');
    //     $uri = preg_replace('#/+#', '/', $uri);

    //     $matchedRoute = $this->matchRoute($method, $uri);

    //     if ($matchedRoute) {
    //         list($controller, $action, $params) = $matchedRoute;
    //         $controller = "App\\App\\Controller\\{$controller}";

    //         if ($this->isInstantiable($controller) && $this->hasMethod($controller, $action)) {
    //             $reflectionClass = new ReflectionClass($controller);
    //             $constructor = $reflectionClass->getConstructor();
                
    //             if ($constructor) {
    //                 $dependencies = [];
    //                 foreach ($constructor->getParameters() as $param) {
    //                     $paramType = $param->getType();
    //                     if ($paramType && !$paramType->isBuiltin()) {
    //                         $dependencies[] = $this->providerServices->getService($paramType->getName());
    //                     }
    //                 }
    //                 $controllerInstance = $reflectionClass->newInstanceArgs($dependencies);
    //             } else {
    //                 $controllerInstance = $reflectionClass->newInstance();
    //             }

    //             $reflectionMethod = new ReflectionMethod($controller, $action);
    //             $reflectionMethod->invokeArgs($controllerInstance, $params);
    //         } else {
    //             // ErrorController::notFound();
    //         }
    //     } else {
    //         // ErrorController::notFound();
    //     }
    // }


    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $uri = preg_replace('#/+#', '/', $uri);

        $matchedRoute = $this->matchRoute($method, $uri);

        if ($matchedRoute) {
            list($controller, $action, $params) = $matchedRoute;
            $controller = "App\\App\\Controller\\{$controller}";

            if ($this->isInstantiable($controller) && $this->hasMethod($controller, $action)) {
                $reflectionClass = new ReflectionClass($controller);
                $constructor = $reflectionClass->getConstructor();
                
                if ($constructor) {
                    $dependencies = [];
                    foreach ($constructor->getParameters() as $param) {
                        $paramType = $param->getType();
                        if ($paramType && !$paramType->isBuiltin()) {
                            $dependencies[] = $this->providerServices->getService($paramType->getName());
                        }
                    }
                    $controllerInstance = $reflectionClass->newInstanceArgs($dependencies);
                } else {
                    $controllerInstance = $reflectionClass->newInstance();
                }

                $reflectionMethod = new ReflectionMethod($controller, $action);
                $reflectionMethod->invokeArgs($controllerInstance, $params);
            } else {
                // ErrorController::notFound();
            }
        } else {
            // ErrorController::notFound();
        }
    }

    private function matchRoute($method, $uri) {
        foreach ($this->routes[$method] as $route => $controllerAction) {
        
            $routePattern = preg_replace('#\#([\p{L}\p{N}]{1,})\##u', '([^/]{1,})', $route);
            if (preg_match("#^{$routePattern}$#", $uri, $matches)) {
                list($controller, $action) = explode('=>', $controllerAction);
                array_shift($matches); // remove the full match
                return [$controller, $action, $matches];
            }
        }
        return false;
    }
    private function isInstantiable($class) {
        $reflectionClass = new ReflectionClass($class);
        return $reflectionClass->isInstantiable();
    }

    private function hasMethod($class, $method) {
        $reflectionClass = new ReflectionClass($class);
        return $reflectionClass->hasMethod($method) && $reflectionClass->getMethod($method)->isPublic();
    }

}
