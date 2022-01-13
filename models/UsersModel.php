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
        public function modelGetRecord(){
            $id = isset($_GET["id"])&&$_GET["id"] > 0 ? $_GET["id"] : 0;
            $conn = Connection::getInstance();
            $query = $conn->query("select * from users where id=$id");
            return $query->fetch();
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
                move_uploaded_file($_FILES["avatar"]["tmp_name"],"assets/upload/users/$avatar");
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

        public function modelUpdate(){
            $id = isset($_GET["id"])&&$_GET["id"] > 0 ? $_GET["id"] : 0;
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $status = isset($_POST["status"]) ? 1: 0;
            $conn = Connection::getInstance();
            $query = $conn->prepare("update users set name=:var_name, email=:var_email, password=:var_password, status=:var_status where id=$id");
            $query->execute(array("var_name"=>$name, "var_email"=>$email, "status"=>$status, "var_password"=>$password));

            $avatar = "";
            if($_FILES["avatar"]["name"] != ""){
                $oldPhoto = $conn->query("select avatar from users where id=$id");
                if($oldPhoto->rowCount() > 0){
                    $record = $oldPhoto->fetch();
                    //delete avatar
                    if($record->avatar != "" && file_exists("assets/upload/users/".$record->avatar))
                        unlink("assets/upload/users/".$record->avatar);
                }
                //-------
                $avatar = time()."_".$_FILES["avatar"]["name"];
                move_uploaded_file($_FILES["avatar"]["tmp_name"],"assets/upload/users/$avatar");
                $query = $conn->prepare("update users set avatar=:var_avatar where id=$id");
                $query->execute(array("var_avatar"=>$avatar));
            }

        }
        public function modelDelete()
        {
            $id = isset($_GET["id"]) && $_GET["id"] > 0 ? $_GET["id"] : 0;
            $conn = Connection::getInstance();
            $oldPhoto = $conn->query("select avatar from users where id=$id");
            if ($oldPhoto->rowCount() > 0) {
                $record = $oldPhoto->fetch();
                //delete avatar
                if ($record->photo != "" && file_exists("assets/upload/users/" . $record->avatar))
                    unlink("assets/upload/users/" . $record->avatar);
            }
            $conn->query("delete from users where id=$id");
        }
    }
 ?>