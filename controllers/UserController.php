<?php
require_once('controllers/BaseController.php');
require_once('models/UserModel.php');
require_once ('component/Config.php');
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
        $recordPerPage=RECORD_PER_PAGE;
        $numPage = ceil($this->userModel->totalRecord() / $recordPerPage);
        $data = $this->userModel->readRecord($recordPerPage);
        $this->render('index', array("data" => $data, "numPage" => $numPage));
    }



    public function create()
    {
        $error = [];
        if (isset($_POST['save'])) {
            $post=array_merge($_POST['save'],['avatar' => $_FILES['avatar']['name']]);
            $error=UserValidate::validCreate($post);

            empty($_POST["status"]);

            if (empty($data)) {
                $arr=$post;
                $arr['password']=md5($post['password']);
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

        $this->render('create', $error);

    }
    function update()
    {
        $id = $_GET['id'];
        $data = $this->userModel->getID($id);
        $error = [];
        if (isset($_POST['save'])) {
            $post=array_merge($_POST['save'],['avatar' => $_FILES['avatar']['name']]);
            $arr=UserValidate::validateUpdate($data,$post);
            extract($arr);
            $status = $_POST['status'];
            $dataUp = array(
                'avatar' => $data['avatar'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'status' => $data['status'],
            );
            $upload_file = 'assets/upload/user/' . $_FILES['avatar']['name'];
            if ($this->userModel->update($dataUp, "`id` = '{$id}'")) {
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
        if ($this->userModel->delete("`id`={$id}")) {
            header("Location: index.php?controller=user&action=index");
        }
    }
    function search(){
        $this->render('search');
    }
    public function login()
    {
        $data=[];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
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
                $loggedInUser = UserModel::login($_POST['email'], $_POST['password']);

            } else {
                $this->render('login', $data);
            }

        } else {

            //load view
            $this->render('login', $data);
        }
    }

}
