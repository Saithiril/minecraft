<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

    set_include_path("protected/controllers/". PATH_SEPARATOR ."protected/components/". PATH_SEPARATOR ."protected/views/". PATH_SEPARATOR ."protected/models/");
    include('protected/config/main.php');

    $params = array();
    $uri = trim(substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], $config['host']) + strlen($config['host'])), '/');
    if($uri) {
        $params = explode('/', $uri);
    }

    $className = null;
    if(isset($params[0])) {
        $className = "{$params[0]}Controller";
    } else {
        $className = "SiteController";
    }
    include "$className.php";

    $action = 'index';
    $controller = new $className();
    if(isset($params[1])) {
        if(property_exists($controller, $params[1])) {
            $action = $params[1];
        }
    }
    $controller->{"{$action}Action"}();