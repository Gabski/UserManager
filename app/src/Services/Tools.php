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
}