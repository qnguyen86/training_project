<?php
require_once('models/BaseModel.php');
require_once('component/ValidationComponent.php');

class UserModel extends BaseModel
{
    public $tableName = '';
    public function __construct()
    {

        $this->db = DB::getInstance();
        $this->tableName = "users";
    }
    public function modelRead($recordPerPage)
    {
        $page = isset($_GET["page"]) && $_GET["page"] > 0 ? $_GET["page"] - 1 : 0;
        $from = $page * $recordPerPage;
        $conn = DB::getInstance();
        $query = $conn->query("select * from users where del_flag='0' order by id desc limit $from, $recordPerPage");
        return $query->fetchAll();
    }

    public function modelTotalRecord()
    {
        $conn = DB::getInstance();
        $query = $conn->query("select id from users");
        return $query->rowCount();
    }
    public function modelGetID($id)
    {
        return $this->db->query("SELECT * FROM `{$this->tableName}` WHERE `id` = '{$id}' ")->fetch();

    }



}