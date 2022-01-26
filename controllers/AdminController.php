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
        $recordPerPage = 2;
        $numPage = ceil($this->adminModel->modelTotalRecord() / $recordPerPage);
        $data = $this->adminModel->modelRead($recordPerPage);
        $this->render('index', array("data" => $data, "numPage" => $numPage));
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
            empty($_POST["role_type"]);

            if (empty($data)) {
                $uploadFile = 'assets/upload/admin/' . $_FILES["avatar"]["name"];
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
            } else {
                $data['alert-fail'] = INSERT_FAIL;
            }

        }

        $this->render('create', $data);

    }

    function update()
    {
        $id = $_GET['id'];
        $data = $this->adminModel->modelGetID($id);
        $err = [];
        if (isset($_POST['save'])) {
            if (empty($_POST['name'])) {
                $err['name_err'] = ERROR_NAME;
            }
            $name = !empty($err['name_err']) ? $data['name'] : $_POST['name'];
            if (empty($_POST['email'])) {
                $err['email_err'] = ERROR_EMAIl;
            }
            $email = !empty($err['email_err']) ? $data['email'] : $_POST['email'];
            if (empty($_POST['password'])) {
                $err['password_err'] = ERROR_PASSWORD_ONE;
            }
            $password = !empty($err['password_err']) ? $data['password'] : $_POST['password'];
            $avatar = $_FILES['avatar']['name'];
            $role_type = $_POST['role_type'];
            $arr = array(
                'avatar' => $avatar,
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role_type' => $role_type,
            );
            $upload_file = 'assets/upload/admin/' . $_FILES['avatar']['name'];
            if ($this->adminModel->update($arr, "`id` = '{$id}'")) {
                move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_file);
                $data['alert-success'] = UPDATE_PASS;
            }
        }
        $mag = array(
            'error' => $err,
            'data' => $data,
        );
        $this->render('update', $mag);
    }
    function delete(){
        $id = $_GET['id'];
        if ($this->adminModel->delete("`id`={$id}")) {
            header("Location: index.php?controller=admin&action=index");
        }
    }
    function search(){
        $this->render('search');
    }

}
