<?php
trait UsersModel{
    public function modelRead($recordPerPage){
        $page = isset($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
        $from = $page * $recordPerPage;
        $conn = Connection::getInstance();
        $query = $conn->query("select * from users order by id desc limit $from, $recordPerPage");
        return $query->fetchAll();
        //---
    }
    public function modelTotalRecord(){
        $conn = Connection::getInstance();
        $query = $conn->query("select id from users");
        return $query->rowCount();
    }


    public function modelCreate(){
        $id = isset($_GET["id"])&&$_GET["id"] > 0 ? $_GET["id"] : 0;
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $status = isset($_POST["status"]) ? 1: 0;
        $avatar = "";
        if($_FILES["avatar"]["name"] != ""){
            $avatar = time()."_".$_FILES["avatar"]["name"];
            move_uploaded_file($_FILES["avatar"]["tmp_name"],"assets/upload/user/$avatar");
        }

        $conn = Connection::getInstance();
        $query = $conn->prepare("insert users set name=:var_name, email=:var_email, password=:var_password, status=:var_status, avatar=:var_avatar");
        $query->execute(array("var_name"=>$name, "var_email"=>$email, "var_status"=>$status, "var_password"=>$password, "var_avatar"=>$avatar));
        //-------
        if ($query) {
            $_SESSION['success'] = 'Insert dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Insert dữ liệu thất bại';
        }
    }


}
?>