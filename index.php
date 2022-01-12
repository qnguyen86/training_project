<?php 
    session_start();
    require_once"Connection.php";
    require_once"controllers/BaseController.php";
 ?>
 <?php
    $controller = isset($_GET["controller"])?$_GET["controller"]:"Home";
    $action = isset($_GET["action"])?$_GET["action"]:"index";
    $controllerFile = "controllers/".ucfirst($controller)."Controller.php";
    if(file_exists($controllerFile)){
        include $controllerFile;
        $controllerClass = $controller."Controller";
        //khoi tao object cua class
        $obj = new $controllerClass();
        //goi den action
        $obj->$action();
        
    }else die("File controller không tồn tại");
 ?>
 