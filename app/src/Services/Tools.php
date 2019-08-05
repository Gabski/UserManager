<?php

class Tools
{
    public static function serverUrl($request = false)
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
            "https" : "http") . "://" . $_SERVER['HTTP_HOST'];

        if ($request) {
            $link .= $_SERVER['REQUEST_URI'];
        }

        return $link;
    }

    public static function listen($event, &$obj)
    {
        $request = $_REQUEST;
        if (isset($request['event']) && $request['event'] == $event) {

            $request = array_merge($request, $_FILES);

            if (is_array($request)) {
                foreach ($request as $key => $value) {
                    $setter = "set" . ucfirst($key);

                    if (method_exists($obj, $setter)) {
                        $obj->$setter($value);
                    }
                }
            }
            return true;
        }
        return false;
    }
}