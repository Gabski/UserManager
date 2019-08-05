<?php
session_start();
require_once 'app/init.php';

Router::add("/", "PageController", 'home');
Router::add("/404", "PageController", 'no_page');
Router::add("/api/register", "RegisterController", 'register');
Router::add("/api/save", "AdminController", 'save');
Router::add("/admin", "AdminController", 'list');
Router::add("/admin/user/int:user_id", "AdminController", 'user');

try {
    $watch = Router::watch();
    if (is_object($watch) && ($watch instanceof ResponseInterface)) {
        $watch->render();
    } else if (is_string($watch)) {
        echo $watch;
    } else {
        var_dump($watch);
    }

} catch (Exception $e) {
    header('Location: /404');
    die();
}

Db::close();