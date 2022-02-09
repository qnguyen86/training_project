<?php
require_once "DBInterface.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');

abstract class BaseModel implements DBInterface
{
    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function insert($data = [])
    {
        $ins = ['ins_id' => $_SESSION['admin']['login']['id'], 'ins_datetime' => date("y-m-d H:i:s "),];
        $data = array_merge($data, $ins);
        $fields = "";
        $values = "";
        foreach ($data as $key => $value) {
            $fields .= "`" . $key . "`, ";
            $values .= "'" . $value . "', ";
        }
        $fields = substr($fields, 0, -2);
        $values = substr($values, 0, -2);
        $sql = "INSERT INTO {$this->tableName} ($fields) VALUES ($values)";
        $arr = $this->db->query($sql);
        return $arr ? true : false;
    }

    public function update($data = [], $condition = "")
    {
        $upd = ['upd_id' => $_SESSION['admin']['login']['id'], 'upd_datetime' => date("Y-m-d H:i:s "),];
        $data = array_merge($data, $upd);
        $sql = "";
        foreach ($data as $field => $value) {
            $sql .= "{$field} = '{$value}', ";
        }
        $sql = substr($sql, 0, -2);
        $sql = "UPDATE {$this->tableName} SET $sql WHERE $condition";
        //UPDATE admin SET name = "NguyenVanB" WHERE id= 15;
        $arr = $this->db->query($sql);
        return $arr ? true : false;
    }

    public function delete($condition = "")
    {
        $sql = "UPDATE {$this->tableName} SET `del_flag` = '" . '1' . "' WHERE $condition";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }
    function is_email($email) {
        return (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
    }
    public function findEmail($email)
    {
        if (!empty($email))
            return $this->db->query("SELECT `email` FROM `{$this->tableName}` WHERE `email` LIKE '{$email}' AND `del_flag` = '0'")->rowCount();
    }
    function is_name($name) {
        return (preg_match("/^[a-zA-z]*$/", $name)) ? FALSE : TRUE;
    }

}