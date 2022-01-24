<?php
require_once "DBInterface.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');
abstract class BaseModel implements DBInterface
{
    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function insert($data=[])
    {

        $ins = ['ins_id' => 0, 'ins_datetime' => date("y-m-d H:i:s "),];
        $data = array_merge($data, $ins);

        $fields = "";
        $values = "";
        foreach ($data as $key => $value) {
            $fields .= "`" . $key . "`, ";
            $values .= "'" . $value . "', ";
        }
        $fields = substr($fields, 0, -2);
        $values = substr($values, 0, -2);
        echo $sql = "INSERT INTO {$this->tableName} ($fields) VALUES ($values)";
        $arr = $this->db->query($sql);
        return $arr ? true : false;
    }

    public function update() {}

    public function delete() {}
}