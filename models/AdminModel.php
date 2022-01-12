<?php 
	trait AdminModel{
		public function modelRead($recordPerPage){
			$page = isset($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			$from = $page * $recordPerPage;
			$conn = Connection::getInstance();
			$query = $conn->query("select * from admin order by id desc limit $from, $recordPerPage");
			return $query->fetchAll();
			//--- 
		}
		public function modelTotalRecord(){
			$conn = Connection::getInstance();
			$query = $conn->query("select id from admin");
			return $query->rowCount();
		}
		public function modelGetRecord(){
			$id = isset($_GET["id"])&&$_GET["id"] > 0 ? $_GET["id"] : 0;
			$conn = Connection::getInstance();
			$query = $conn->query("select * from admin where id=$id");
			return $query->fetch();
		}
		
		public function modelCreate(){
			$id = isset($_GET["id"])&&$_GET["id"] > 0 ? $_GET["id"] : 0;
			$name = $_POST["name"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$role_type = isset($_POST["role_type"]) ? 1: 0;
			$avatar = "";
			if($_FILES["avatar"]["name"] != ""){
				$avatar = time()."_".$_FILES["avatar"]["name"];
				move_uploaded_file($_FILES["avatar"]["tmp_name"],"assets/upload/news/$avatar");
			}
		
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert admin set name=:var_name, email=:var_email, password=:var_password, role_type=:var_role, avatar=:var_avatar");
			$query->execute(array("var_name"=>$name, "var_email"=>$email, "var_role"=>$role_type, "var_password"=>$password, "var_avatar"=>$avatar));
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
            $role_type = isset($_POST["role_type"]) ? 1: 0;
            $conn = Connection::getInstance();
            $query = $conn->prepare("update admin set name=:var_name, email=:var_email, password=:var_password, role_type=:var_role where id=$id");
            $query->execute(array("var_name"=>$name, "var_email"=>$email, "var_role"=>$role_type, "var_password"=>$password));

            $avatar = "";
            if($_FILES["avatar"]["name"] != ""){
                $oldPhoto = $conn->query("select avatar from admin where id=$id");
                if($oldPhoto->rowCount() > 0){
                    $record = $oldPhoto->fetch();
                    //delete avatar
                    if($record->avatar != "" && file_exists("assets/upload/news/".$record->avatar))
                        unlink("assets/upload/news/".$record->avatar);
                }
                //-------
                $avatar = time()."_".$_FILES["avatar"]["name"];
                move_uploaded_file($_FILES["avatar"]["tmp_name"],"assets/upload/news/$avatar");
                $query = $conn->prepare("update admin set avatar=:var_avatar where id=$id");
                $query->execute(array("var_avatar"=>$avatar));
            }

        }
        public function modelDelete()
        {
            $id = isset($_GET["id"]) && $_GET["id"] > 0 ? $_GET["id"] : 0;
            $conn = Connection::getInstance();
            $oldPhoto = $conn->query("select avatar from admin where id=$id");
            if ($oldPhoto->rowCount() > 0) {
                $record = $oldPhoto->fetch();
                //delete avatar
                if ($record->photo != "" && file_exists("assets/upload/news/" . $record->avatar))
                    unlink("assets/upload/news/" . $record->avatar);
            }
            $conn->query("delete from admin where id=$id");
        }
	}
 ?>