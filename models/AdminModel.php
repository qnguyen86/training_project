<?php
class AdminModel
{
    public $id;
    public $email;
    public $password;

    function __construct($id, $email, $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }
    static function all()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT id,email,password FROM admin');

        foreach ($req->fetchAll() as $item) {
            $list[] = new AdminModel($item['id'], $item['email'], $item['password']);
        }

        return $list;
    }
    public function login(){

        $email=$_POST['email'];
        $password=$_POST['password'];
        $db= DB::getInstance();

        $req = $db->prepare("select email from admin where email= :email and password = :password");
        $req->execute(array("email"=>$email,"password"=>$password));
        if($req->rowCount() > 0){

            $_SESSION["email"] = $email;
            header("location:index.php?controller=admin&action=index");
        }
    }
    public function createAccount()
    {

        $db = DB::getInstance();

        $req = $db->prepare("insert into admin set name=:var_name, email=:var_email, password=:var_password, avatar=:var_avatar");
        $req->execute(array("var_name"=>$name,"var_email"=>$email,"var_password"=>$password,"var_avatar"=>$avatar));

    }



}
