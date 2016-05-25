<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    set_include_path("protected/controllers/". PATH_SEPARATOR ."protected/components/". PATH_SEPARATOR ."protected/views/". PATH_SEPARATOR ."protected/models/". PATH_SEPARATOR ."protected/config/");
    include('protected/config/main.php');

    $params = array();
    if($config['host'] && strpos($_SERVER['REQUEST_URI'], $config['host'])){
        $uri = trim(substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], $config['host']) + strlen($config['host'])), '/');
    } else {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
    }
    if($uri) {
        $params = explode('/', $uri);
    }

    if(count($params) < 2) {
        // костыль для Рема
        session_start();
        $_SESSION['config'] = $config;
        include "SiteController.php";
        $controller = new SiteController();
        $controller->indexAction();
        return;
    }

    $className = null;
    if(isset($params[0])) {
        $controller_name = ucfirst($params[0]);
        $className = "{$controller_name}Controller";
    } else {
        $className = "SiteController";
    }
    session_start();
    $_SESSION['config'] = $config;
    include "$className.php";

    $action = 'index';
    $controller = new $className();
    $getParams = array();

    if(isset($params[1])) {
        $actionName = mb_strtolower(explode('?', $params[1])[0]);
        if(method_exists($className, $actionName."Action")) {
            $action = $actionName;
        }
        $get = explode('?', $uri);
        if(count($get) > 1) {
            $get = $get[1];
            $getParams = array_map(function($item){$equal = explode("=", $item); return array($equal[0] => isset($equal[1]) ? $equal[1] : '');}, explode("&", $get));
        }
    }

    $controller->{"{$action}Action"}();