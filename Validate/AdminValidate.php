<?php
require_once ('Validate/BaseValidate.php');
class AdminValidate extends BaseValidate{
    public  function __construct()
    {
        $this->adminValid = new AdminValidate();
    }

    public function validCreate($post){
        $validEmail=$this->userValid->validateEmail($post['email']);
        $validName=$this->userValid->validateName($post['name']);
        $validPass=$this->userValid->validatePassword($post['password']);
        $validAvatar=$this->userValid->validateAvatar('avatar');
        $error=array_merge($validEmail,$validName,$validPass,$validAvatar);
        return $error;
    }
    public function validateUpdate($data,$post){
        $validEmail=$this->userValid->validateEmail($post['email']);
        $validName=$this->userValid->validateName($post['name']);
        $validPass=$this->userValid->validatePassword($post['password']);
        $validAvatar=$this->userValid->validateAvatar('avatar');
        $error=[];
        if ($post['email'] != "") {
            if (empty($validEmail)) {
                $data['email'] = $post['email'];
            } else {
                $error = $validEmail;
            }
        }
        if ($post['name'] != "") {
            if (empty($validName)) {
                $data['name'] = $post['name'];
            } else {
                $error = $validName;
            }
        }
        if ($post['password'] != "") {
            if (empty($validPass)) {
                $data['password'] = $post['password'];
            } else {
                $error = $validPass;
            }
        }
        if ($post['avatar'] != "") {
            if (empty($validAvatar)) {
                $data['avatar'] = $post['avatar'];
            } else {
                $error = $validAvatar;
            }
        }
        $temp = array(
            'error' => $error,
            'data' => $data,
        );
        return $temp;
    }

}

?>