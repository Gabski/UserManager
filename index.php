<?php
session_start();
require_once 'app/init.php';

Router::add("/", "PageController", 'home');
Router::add("/404", "PageController", 'no_page');

try {
    $watch = Router::watch();
    if (is_string($watch)) {
        echo $watch;
    } else {
        var_dump($watch);
    }

} catch (Exception $e) {
    header('Location: /404');
    die();
}