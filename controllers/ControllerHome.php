
<?php

    class ControllerHome extends BaseController{
      
        public function __construct(){
            $this->authentication();
        }
        public function index(){
            $this->loadView("ViewHome.php");
        }
    }
?>