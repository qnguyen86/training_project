<?php
require_once('controllers/BaseController.php');
require_once ('models/AdminModel.php');
class AdminController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'admin';
    }

    public function index()
    {
        $admins = AdminModel::all();
        $data = ["admins" => $admins];
        $this->render('index', $data);
    }

    public function home()
    {
        $data = ["email" => "abc@gmail.com", "password" => "123456"];
        $this->render('home', $data);
    }

    public function error()
    {
        $this->render('error');
    }


    public function login()
    {
        $admins = AdminModel::login();
        //$data = ["admins"=>$admins];
        $data = array(
            'email' => " ",
            'password' => " ",
            'emailError' => " ",
            'passwordError' => " "
        );
        //Validate username
        if (empty($data['email'])) {
            $data['emailError'] = 'Please enter a username.';
        }

        //Validate password
        if (empty($data['password'])) {
            $data['passwordError'] = 'Please enter a password.';
        }
        $this->render('login', $data);
    }
    public function logout(){
        unset($_SESSION["email"]);
        header("location:index.php?controller=admin&action=login");
    }

    public function create(){

        if($_FILES["avatar"]["name"] != ""){
            $avatar = time()."_".$_FILES["avatar"]["name"];
            move_uploaded_file($_FILES["avatar"]["tmp_name"],"./assets/admin/upload/$avatar");
        }
        $admins = AdminModel::createAccount();
        $data = ["admins" => $admins];
        $this->render('create', $data);
    }

}