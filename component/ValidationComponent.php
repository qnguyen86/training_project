<?php
require_once ('models/AdminModel.php');
class ValidationComponent
{
    public function validateLoginAdmin($data){
        $validate[]=[
            'status'=>false,
            'errors'=>[]
        ];
        //validate email
        if(empty($data['email'])){
            $validate['errors']['email'] = 'Please enter email';
        }else{
            if($this->AdminModel->findAdminByEmail($data['email'])){
                //admin found
            }else{
                $validate['errors']['email'] = 'Admin not found';
            }
        }

        //validate password
        if(empty($data['password'])){
            $validate['errors']['password'] = 'Please enter your password';
        }elseif(strlen($data['password']) < 6){
            $validate['errors']['password'] = 'Password must be at least six characters';
        }

        if (empty($validate['errors'])) {
            $validate['status'] = true;
        }
        return $validate;

    }

    public function validateCreateUser($data)
    {
        $validate[] = [
            'status' => false,
            'errors' => []
        ];

        if (empty($data['name'])) {
            $validate['errors']['name'] = NAME_IS_REQUIREd;
        }

        if (empty($validate['errors'])) {
            $validate['status'] = true;
        }

        return $validate;
    }
}