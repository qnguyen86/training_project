<?php
require_once('controllers/BaseController.php');
require_once('models/UserModel.php');
include_once('component/ValidationComponent.php');
include_once('component/Message.php');

class UserController extends BaseController
{
    public $userModel;

    public function __construct()
    {
        $this->folder = 'user';
        $this->userModel = new UserModel();

    }

    public function error()
    {
        $this->render('error');
    }

    public function index()
    {
        $recordPerPage = 2;
        $numPage = ceil($this->userModel->modelTotalRecord() / $recordPerPage);
        $data = $this->userModel->modelRead($recordPerPage);
        $this->render('index', array("data" => $data, "numPage" => $numPage));
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
            empty($_POST["status"]);

            if (empty($data)) {
                $uploadFile = 'assets/upload/user/'.$_FILES["avatar"]["name"];
                $arr = array(
                    'avatar' => $_FILES["avatar"]["name"],
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'status' => $_POST['status'],
                );

                if ($this->userModel->insert($arr)) {
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
    function update()
    {
        $id = $_GET['id'];
        $data = $this->userModel->modelGetID($id);
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
            $status = $_POST['status'];
            $arr = array(
                'avatar' => $avatar,
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'status' => $status,
            );
            $upload_file = 'assets/upload/user/' . $_FILES['avatar']['name'];
            if ($this->userModel->update($arr, "`id` = '{$id}'")) {
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
        if ($this->userModel->delete("`id`={$id}")) {
            header("Location: index.php?controller=user&action=index");
        }
    }
    function search(){
        $this->render('search');
    }

}
