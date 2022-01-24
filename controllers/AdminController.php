<?php
require_once('controllers/BaseController.php');
require_once('models/AdminModel.php');
include_once('component/ValidationComponent.php');
include_once('component/Message.php');

class AdminController extends BaseController
{
    public $adminModel;

    public function __construct()
    {
        $this->folder = 'admin';
        $this->adminModel = new AdminModel();

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
            session_start();
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'email_err' => '',
                'password_err' => ''
            ];
            //validate
            if (empty($_POST['email'])) {
                $data['email_err'] = ERROR_EMAIl;
            }
            if (empty($_POST['password'])) {
                $data['password_err'] = ERROR_PASSWORD_ONE;
            } elseif (strlen($_POST['password']) < 6) {
                $data['password_err'] = ERROR_PASSWORD_TWO;
            }
            //check all error are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                $loggedInUser = AdminModel::login($_POST['email'], $_POST['password']);

            } else {
                $this->render('login', $data);
            }

        } else {

            // init data
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
        $data = [];
        if (isset($_POST['save'])) {
            if (empty($_POST['name'])) {
                $data['name_err'] = ERROR_NAME;
            }
            if (empty($_POST['email'])) {
                $data['email_err'] = ERROR_EMAIl;
            }
            if (empty($_POST['password'])) {
                $data['password_err'] = ERROR_PASSWORD_ONE;
            }

            if (empty($_FILES["avatar"]["name"])) {
                $data['avatar_err'] = ERROR_AVATAR;
            }
            empty($_POST["role_type"]) ;

            if (empty($data)) {
                $uploadFile = 'assets/upload/admin/'.$_FILES["avatar"]["name"];
                $arr = array(
                    'avatar' => $_FILES["avatar"]["name"],
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'role_type' => $_POST['role_type'],
                );

                if ($this->adminModel->insert($arr)) {
                    move_uploaded_file($_FILES["avatar"]["tmp_name"], $uploadFile);
                    $_SESSION['admin']['upload'] = $uploadFile;
                    $data['alert-success'] = INSERT_PASS;
                }
            }else{
                $data['alert-fail'] = INSERT_FAIL;
            }

        }

        $this->render('create', $data);

    }

}
