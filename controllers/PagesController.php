<?php
require_once('controllers/BaseController.php');
class PagesController extends BaseController
{
    function __construct()
    {
     $this->folder='pages'; // pagecontroller chỏ đến biến folder page kiểm tra xem nó có tồn tai hay ko
    }
    function home()
    {
        $data= ["title"=>"This Page"];
        $this->render('home',$data);
    }
    function error()
    {
        $this->render('error');
    }
}

