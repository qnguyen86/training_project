<?php

include "models/UsersModel.php";
class UsersController extends BaseController{

    use UsersModel;
    public function index(){

        $recordPerPage = 12;
        $numPage = ceil($this->modelTotalRecord()/$recordPerPage);
        $data = $this->modelRead($recordPerPage);
        $this->loadView("ViewUsers.php",array("data"=>$data,"numPage"=>$numPage));
    }

    public function create(){

        $action = "index.php?controller=users&action=createPost";
        $this->loadView("ViewFormUsers.php",array("action"=>$action));
    }
    public function createPost(){
        $this->modelCreate();
        header("location:index.php?controller=users");
    }

}
?>