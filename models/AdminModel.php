<?php
require_once('models/BaseModel.php');
require_once ('component/ValidationComponent.php');
class AdminModel extends BaseModel
{
    public $db;
 function __construct(){
    $this->db=DB::getInstance();
}

    public function login($email, $password){
        $query = $this->db->prepare("select email from admin where email= :var_email and password = :var_password");
        $query->execute(array("var_email"=>$email,"var_password"=>$password));
        if($query->rowCount() > 0){
            $_SESSION["email"] = $email;
            header("location:index.php?controller=admin&action=index");
        }
        else
            header("location:index.php?controller=admin&action=login");
    }
    public function insert($data){
       // $conn = DB::getInstance();
//        $query = $conn->prepare("insert  admin set name=:var_name, email=:var_email, password=:var_password, role_type=:var_role, avatar=:var_avatar");
//        $query->execute(array("var_name" => $name, "var_email" => $email, "var_role" => $role_type, "var_password" => $password, "var_avatar" => $avatar));
//        //-------
//        if ($query ) {
//            $_SESSION['success'] = 'Insert dữ liệu thành công';
//        } else {
//            $_SESSION['error'] = 'Insert dữ liệu thất bại';
//        }
        $this->db->query('INSERT INTO admin (name, email, password,avatar) VALUES (:name, :email, :password,:avatar)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':avatar', $data['avatar']);

        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}