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
        public function update(){
            $id = isset($_GET["id"])&&$_GET["id"] > 0 ? $_GET["id"] : 0;
            $record = $this->modelGetRecord();
            $action = "index.php?controller=users&action=updatePost&id=$id";
            $this->loadView("ViewFormUsers.php",array("record"=>$record,"action"=>$action));
        }
        public function updatePost(){
            $id = isset($_GET["id"])&&$_GET["id"] > 0 ? $_GET["id"] : 0;
            $this->modelUpdate();
            header("location:index.php?controller=users");
        }
        public function delete(){
            $id = isset($_GET["id"])&&$_GET["id"] > 0 ? $_GET["id"] : 0;
            $this->modelDelete();
            header("location:index.php?controller=users");
        }
       public function search(){
            $this->loadView('ViewSearchUser.php');
       }
    }
 ?>