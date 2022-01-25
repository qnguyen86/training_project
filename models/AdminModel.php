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
    public function modelRead($recordPerPage)
    {
        $page = isset($_GET["page"]) && $_GET["page"] > 0 ? $_GET["page"] - 1 : 0;
        $from = $page * $recordPerPage;
        $conn = DB::getInstance();
        $query = $conn->query("select * from admin order by id desc limit $from, $recordPerPage");
        return $query->fetchAll();
    }

    public function modelTotalRecord()
    {
        $conn = DB::getInstance();
        $query = $conn->query("select id from admin");
        return $query->rowCount();
    }
    public function modelGetID($id)
    {
        //return $this->db->query("SELECT * FROM `{$this->tableName}` WHERE `id` = '{$id}' ")->fetch();
        $conn = DB::getInstance();
        $query = $conn->query("select * from admin where id='$id'");
        return $query->fetch();
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



}