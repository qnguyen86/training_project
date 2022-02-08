<?php
 abstract class BaseValidate{
     function validateEmail($email){
         $error=[];
         $valid =(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
         if (empty($email)) {
             $error['email_err'] = ERROR_EMAIl;
         }
         else if(!$valid){
             $error['email_err'] = ERROR_INVALID_EMAIl;
         }
         else if(strlen($email) < MIN_LENGTH_EMAIL || strlen($email) > MAX_LENGTH_EMAIL){
             $error['email_err'] = ERROR_LENGTH_EMAIl;
         }
         return $error;
     }
     function validateName($name){
         $error=[];
         $valid=(preg_match("/^[a-zA-z]*$/", $name)) ? FALSE : TRUE;
         if (empty($name)) {
             $error['name_err'] = ERROR_NAME;
         }
         else if(!$valid){
             $error['name_err'] = ERROR_INVALID_NAME;
         }
         else if(strlen($name) < MIN_LENGTH_NAME || strlen($name) > MAX_LENGTH_NAME){
             $error['name_err'] = ERROR_LENGTH_NAME;
         }
         return $error;
     }
     function validatePassword($password){
         $error=[];
         $valid=(preg_match("/^([\w_\.!@#$%^&*()-]+)$/", $password)) ? FALSE : TRUE;
         if (empty($password)) {
             $error['password_err'] = ERROR_PASSWORD_ONE;
         }
         else if(!$valid){
             $error['password_err'] = ERROR_INVALID_PASSWORD;
         }
         else if(strlen($password) < MIN_LENGTH_PASSWORD || strlen($password) > MAX_LENGTH_PASSWORD){
             $error['password_err'] = ERROR_LENGTH_PASSWORD;
         }
         return $error;
     }
 }
?>