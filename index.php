<?php
require_once('connection.php');

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'login';
    }
} else {
    $controller = 'admin';
    $action = 'login';
}
require_once('routes.php');