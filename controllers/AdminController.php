<?php
require_once('controllers/BaseController.php');
require_once('models/AdminModel.php');
require_once ('component/Config.php');
include_once('component/Message.php');
require_once ('Validate/AdminValidate.php');

class AdminController extends BaseController
{
    public $adminModel;

    public function __construct()
    {
        $this->folder = 'admin';
        $this->adminModel = new AdminModel();
        $this->adminvad = new AdminValidate();
    }

    public function error()
    {
        $this->render('error');
    }

    public function index()
    {
        $recordPerPage=RECORD_PER_PAGE;
        $numPage = ceil($this->adminModel->totalRecord() / $recordPerPage);
        $data = $this->adminModel->readRecord($recordPerPage);
        $this->render('index', array("data" => $data,"numPage" => $numPage));
    }

    public function login()
    {
      $data=[];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            else if ($this->adminModel->is_email($_POST['email'])){
                $data['email_err'] = ERROR_INVALID_EMAIl;
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
        $error = [];
        if (isset($_POST['save'])) {
            $post=array_merge($_POST['save'],['avatar' => $_FILES['avatar']['name']]);
            $error=$this->adminvad->validCreate($post);
            empty($_POST["role_type"]);

            if (empty($error)) {
                $arr=$post;
                $arr['password']=md5($post['password']);
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
                    $error['alert-success'] = INSERT_PASS;
                }
            } else {
                $error['alert-fail'] = INSERT_FAIL;
            }

        }

        $this->render('create', $error);

    }

    function update()
    {
        $id = $_GET['id'];
        $data = $this->adminModel->getID($id);
        $error = [];
        if (isset($_POST['save'])) {
            $post=array_merge($_POST['save'],['avatar' => $_FILES['avatar']['name']]);
            $arr=AdminValidate::validateUpdate($data,$post);
            extract($arr);

            $role_type = $_POST['role_type'];
            $dataUp = array(
                'avatar' => $data['avatar'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role_type' => $data['role_type'],
            );
            $upload_file = 'assets/upload/admin/' . $_FILES['avatar']['name'];
            if ($this->adminModel->update($dataUp, "`id` = '{$id}'")) {
                move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_file);
                $data['alert-success'] = UPDATE_PASS;
            }
        }
        $mag = array(
            'error' => $error,
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
    function search()
    {
        $data = [];
        if (isset($_POST['search'])) {
            if (empty($_POST['name'])) {
                $data['name_err'] = ERROR_NAME;
            } else if ($this->adminModel->is_name($_POST['name'])) {
                $data['name_err'] = ERROR_INVALID_NAME;
            }
            if (empty($_POST['email'])) {
                $data['email_err'] = ERROR_EMAIl;
            }
            if ($this->adminModel->searchInfor()) {
                header("Location: index.php?controller=admin&action=index");
            }

        }
        $this->render('search', $data);
    }

}
