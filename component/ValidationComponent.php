<?php
require_once ('models/AdminModel.php');
class ValidationComponent
{
    public function validateLoginAdmin($data){
        $validate[]=[
        ];
        //validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            //validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter your password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least six characters';
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