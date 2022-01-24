<?php
require_once('models/BaseModel.php');
require_once('component/ValidationComponent.php');

class AdminModel extends BaseModel
{
    public $tableName = '';

    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->tableName = "admin";
    }


    public function login($email, $password)
    {
        $conn = DB::getInstance();
        $query = $conn->prepare("select email from admin where email= :var_email and password = :var_password");
        $query->execute(array("var_email" => $email, "var_password" => $password));
        if ($query->rowCount() > 0) {
            $_SESSION["email"] = $email;
            header("location:index.php?controller=admin&action=index");
        } else
            header("location:index.php?controller=admin&action=login");
    }

    static function getIdAdmin($str){
        $db = DB::getInstance();
        $arr = $db->query("SELECT `id` FROM `admin` WHERE `email` LIKE '{$str}'");
        return $arr->fetch();
    }


}