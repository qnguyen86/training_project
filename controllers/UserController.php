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


        $this->render('index');
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

}
