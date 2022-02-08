<?php
require_once('models/BaseModel.php');
require_once ('component/Config.php');

class AdminModel extends BaseModel
{
    public $tableName = '';
    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->tableName = "admin";
    }

    public function readRecord($recordPerPage)
    {
        $page = isset($_GET["page"]) && $_GET["page"] > 0 ? $_GET["page"] - 1 : 0;
        $from = $page * $recordPerPage;
        $query = $this->db->query("select id, name, avatar, email,role_type from {$this->tableName} where del_flag= '0'  order by id desc limit $from, $recordPerPage   ");
        return $query->fetchAll();
    }

    public function totalRecord()
    {
        return $this->db->query("SELECT id FROM `{$this->tableName}` WHERE del_flag= ".ACTIVE)->rowCount();
    }

    public function getID($id)
    {
        return $this->db->query("SELECT id, name, avatar, email,role_type FROM `{$this->tableName}` WHERE `id` = '{$id}' ")->fetch();
    }

    public function login($email, $password)
    {
        $conn=DB::getInstance();
        $query = $conn->prepare("select email from {$this->tableName} where email= :var_email and password = :var_password");
        $query->execute(array("var_email" => $email, "var_password" => $password));
        if ($query->rowCount() > 0) {
            $_SESSION["email"] = $email;
            header("location:index.php?controller=admin&action=index");
        } else
            header("location:index.php?controller=admin&action=login");
    }

    public function searchInfor(){

    }



}