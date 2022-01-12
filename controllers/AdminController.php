<?php 

	include "models/AdminModel.php";
	class AdminController extends BaseController{

		use AdminModel;
		public function index(){

			$recordPerPage = 12;
			
			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			$data = $this->modelRead($recordPerPage);
			$this->loadView("ViewAdmins.php",array("data"=>$data,"numPage"=>$numPage));
		}

		public function create(){

			$action = "index.php?controller=admin&action=createPost";
			$this->loadView("ViewFormAdmins.php",array("action"=>$action));
		}
		public function createPost(){
			$this->modelCreate();
			header("location:index.php?controller=admin");
		}
        public function update(){
            $id = isset($_GET["id"])&&$_GET["id"] > 0 ? $_GET["id"] : 0;
            $record = $this->modelGetRecord();
            $action = "index.php?controller=admin&action=updatePost&id=$id";
            $this->loadView("ViewFormAdmins.php",array("record"=>$record,"action"=>$action));
        }
        public function updatePost(){
            $id = isset($_GET["id"])&&$_GET["id"] > 0 ? $_GET["id"] : 0;
            $this->modelUpdate();
            header("location:index.php?controller=admin");
        }
        public function delete(){
            $id = isset($_GET["id"])&&$_GET["id"] > 0 ? $_GET["id"] : 0;
            $this->modelDelete();
            header("location:index.php?controller=admin");
        }
	}
 ?>