<?php
// abstraction for the super global variable : $_SERVER

namespace app\core;


class Request
{
    public array $routeParams = [];
    public array $params = [];

    public function getPath ()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if (!$position) {
            return $path;
        }
        
        $params = substr($path, $position + 1);
        $params = explode('&', $params);

        foreach ($params as $param) {
            $cut = explode('=', $param);
            $this->params[$cut[0]] = $cut[1];
        }

        return substr($path, 0, $position);
    }

    public function method ()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->method() === "get";
    }

    public function isPost()
    {
        return $this->method() === "post";
    }

    public function getBody()
    {
        $body = [];

        // remove malicious text (XSS attack)
        if ($this->method() === "get") {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() === "post") {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    public function getRouteParam(string $name)
    {
        return $this->routeParams[$name];
    }

    public function getParam(string $name)
    {
        return $this->params[$name];
    }
}