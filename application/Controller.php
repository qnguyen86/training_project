<?php 
  class Controller{
    public $fileName = NULL;
    public $fileLayout = NULL;
    public $view = NULL;
    public function loadView($fileName,$data=NULL){
      if($data != NULL)
        extract($data);
      if(file_exists("views/$fileName")){
        $this->fileName = $fileName;

        ob_start();       
          include "views/$fileName";
          $this->view = ob_get_contents();
        ob_end_clean();
        //kiem tra neu bien $this->fileLayout khong NULL thi include no
        if($this->fileLayout != NULL)
          include "views/$this->fileLayout";
        else
          echo $this->view;
      }
    }
    public function authentication(){
      if(isset($_SESSION["email"]) ==  false)
        header("location:index.php?controller=login");
    }
  }
 ?>