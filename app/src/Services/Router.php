<?php
class Router
{

    protected static $routers = [];
    protected static $baseUrl = "";

    public static function add(string $route, string $class, string $method = "run", array $data = [])
    {
        self::$routers[] = array('path' => $route, 'controler' => $class, 'method' => $method, 'data' => $data);
    }

    public static function watch()
    {
        $uri = $_SERVER["REQUEST_URI"];
        $uriEx = explode("/", $uri);

        foreach (self::$routers as &$rute) {
            $pathEx = explode("/", $rute['path']);

            if ($arg = self::compare($pathEx, $uriEx)) {
                $arg = is_array($arg) ? array_merge($arg, $rute['data']) : $rute['data'];
                return self::go($rute['controler'], $rute['method'], $arg);
            }
        }

        throw new Exception("Nie ma takiej strony");
    }

    private static function compare($pathEx, $uriEx)
    {
        $arg = [];

        if (count($uriEx) !== count($pathEx)) {
            return false;
        }

        for ($i = 0; $i < count($uriEx); $i++) {
            $args = explode(":", $pathEx[$i]);

            if (sizeof($args) == 1) {
                if ($uriEx[$i] != $pathEx[$i]) {
                    return false;
                }
            } elseif ($args[0] == '') {
                return false;
            } else {
                $type = $args[0];
                $key = $args[1];
                $arg[$key] = $uriEx[$i];
            }
        }

        return empty($arg) ? true : $arg;
    }

    public static function go($controler, $method = "run", $arg = [])
    {
        if (!class_exists($controler)) {
            throw new Exception("Nie ma takiej strony");
        } else {
            $new = new $controler();
        }

        return $new->$method($arg);
    }
}