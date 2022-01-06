<?php
$controllers = array(
    'pages' => ['home', 'error'],
    'admin'=>['home','error','index','login','logout','create']
); // Các controllers trong hệ thống và các action có thể gọi ra từ controller đó.

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'pages';
    $action = 'error';

}
include_once('controllers/' . ucfirst($controller) . 'Controller.php');

$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();