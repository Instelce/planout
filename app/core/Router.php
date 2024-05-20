<?php

namespace app\core;

use app\core\exceptions\NotFoundException;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * Retourne la vue correspondant à la route courante
     * @return array|false|mixed|string|string[]
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        // check if path has params like /projets/<pk:int> and get the value (/projets/1 => 1)
        $selectedRoute = null;
        foreach ($this->routes[$method] as $route => $routeCallback) {
            $params = explode('/', $route);
            $pathParts = explode('/', $path);
            $pathWithoutValue = implode('/', array_slice($pathParts, 0, count($pathParts) - 1));

            if (count($params) === count($pathParts) && substr($route, 0, strpos($route, '/<')) === $pathWithoutValue) {
                foreach ($params as $i => $param) {
                    if (preg_match('<(\w+):(\w+)>', $param, $matches)) {
                        $paramName = $matches[1];
                        $paramType = $matches[2];
                        if ($paramType === 'int') {
                            if (is_numeric($pathParts[$i])) {
                                $selectedRoute = $route;
                                $this->request->routeParams[$paramName] = (int)$pathParts[$i];
                            }
                        }
                    }
                }
            }
        }

        if ($selectedRoute) {
            $callback = $this->routes[$method][$selectedRoute];
        }

        if (!$callback) {
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }

        // create instance of a Controller
        if (is_array($callback)) {
            /**
             * @var Controller $controller
             */
            $controller = new $callback[0];
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }

        // call the controller method, and pass request and response to the method
        return call_user_func($callback, $this->request, $this->response);
    }

}