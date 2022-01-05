<?php
    class ControllerHome extends Controller{

        public function __construct(){
            $this->authentication();
        }
        public function index(){

            $this->loadView("ViewHome.php");
        }
    }
?>