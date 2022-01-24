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




}