<?php 

	include "models/ModelAdmin.php";
	class ControllerAdmin extends BaseController{

		use ModelAdmin;
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
	
	}
 ?>