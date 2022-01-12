<?php
    class LoginController extends BaseController{
        public function index(){
            $this->loadView("ViewLogin.php");
        }
        public function login(){
            $email = $_POST["email"];
            $password = $_POST["password"];
            $conn = Connection::getInstance();
            $query = $conn->prepare("select email from admin where email= :var_email and password = :var_password");
            $query->execute(array("var_email"=>$email,"var_password"=>$password));
            if($query->rowCount() > 0){
            $_SESSION["email"] = $email;
            header("location:index.php");
            }
            else
            header("location:index.php?controller=login");
        }
        //logout
        public function logout(){
            unset($_SESSION["email"]);
            header("location:index.php");
        }
    }
?>