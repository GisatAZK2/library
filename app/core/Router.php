<?php

class Router {
    private static $routes= [];

    private static function addRoute($method, $uri, $action) {
        $pattern = preg_replace('#\{([^}]+)\}#','([^/]+)', $uri);
        $pattern = "#^" . $pattern . "$#";

        self::$routes[$method][] = [
            'uri' => $uri,
            'pattern' => $pattern,
            'action' => $action
        ];
    }

    private static function AddBody () {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'POST') {
            return $_POST;
        }
        if ($method === 'PUT' || $method === 'DELETE') {
            parse_str(file_get_contents("php://input"), $data);
            return $data;
        }
        return [];
    }

    public static function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        $routes = self::$routes[$method] ?? [];

        foreach ($routes as $route) {
            if (preg_match($route['pattern'],$uri, $matches)) {
                array_shift($matches);
                list($controller, $addMethod) = explode("@", $route['action']);
                require_once __DIR__ . "/../controllers/$controller.php";
                $controller = new $controller;
                $body = self::AddBody();
                return call_user_func_array([$controller, $addMethod], [...$matches, $body]);
            }
        }

        if (http_response_code(404)) {
            echo "Yey Gak Ketemu";
        } elseif (http_response_code(500)) {
            echo "Awass Ada Nuklirr";
        }
    }

    public static function get ($uri, $action) {
        self::addRoute('GET', $uri, $action);
    }
    
    public static function post ($uri, $action) {
        self::addRoute('POST', $uri, $action);
    }
    
    public static function put ($uri, $action) {
        self::addRoute('PUT', $uri, $action);
    }
    
    public static function delete ($uri, $action) {
        self::addRoute('DELETE', $uri, $action);
    }
}