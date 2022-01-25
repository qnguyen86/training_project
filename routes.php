<?php
$controllers = array(
    'admin' => ['index', 'error', 'login', 'search', 'create', 'update', 'delete'],
    'user' => ['index', 'error', 'create', 'update', 'delete']
);

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'admin';
    $action = 'login';
}

include_once('controllers/' . ucfirst($controller) . 'Controller.php');
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();