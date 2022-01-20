<?php
require_once('controllers/BaseController.php');
require_once('controllers/AdminController.php');
require_once('component/ValidationComponent.php');

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'admin';
    }

    public function error()
    {
        $this->render('error');
    }

    public function index()
    {
        $this->render('index');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form

            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'email_err' => '',
                'password_err' => ''
            ];

            //validate
            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            //validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter your password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least six characters';
            }


            //check all error are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                $loginIn = AdminModel::login($data['email'], $data['password']);

            } else {
                $this->render('login', $data);
            }

        } else {
            //init data f f
            $data = [
                'email' => '',
                'password' => '',

            ];
            //load view
            $this->render('login', $data);
        }
    }

    public function logout()
    {
        unset($_SESSION["email"]);
        header("location:index.php");
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ins_id ='';
            $upd_id='';
            $data = [
                'name' => $_POST['title'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'password_verify' => $_POST['password_verify'],
                'ins_id' => $ins_id,
                'upd_id' => $upd_id ,
                'avatar' => "",
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'password_verify_err' => '',
            ];
            if ($_FILES["avatar"]["name"] != "") {
                $avatar = time() . "_" . $_FILES["avatar"]["name"];
                move_uploaded_file($_FILES["avatar"]["tmp_name"], "assets/upload/news/$avatar");
            }

            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }
            if ($data['password'] != $data['password_verify']) {
                $data['password_verify_err'] = 'Password is not correct';
            }

            //check all error
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['password_verify_err']) ) {
               $add= AdminModel::insert($data);

                //load view with error
            } else {
                $this->render('create', $data);
            }
        } else {
            $data = [
                'avatar' => (isset($_POST['avatar']) ? $_POST['avatar'] : ''),
                'name' => (isset($_POST['name']) ? $_POST['name'] : ''),
                'email' => (isset($_POST['email']) ? $_POST['email'] : ''),
                'password' => (isset($_POST['password']) ? $_POST['password'] : ''),
                'password_verify' => (isset($_POST['password_verify']) ? $_POST['password_verify'] : ''),
            ];

            $this->render('create', $data);
        }


    }


}
