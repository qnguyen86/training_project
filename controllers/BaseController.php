<?php
class BaseController
{
    protected $folder; // biến thư mục view chứa các file view template
    function render($file,$data = array())
    {
        //Kiểm tra file gọi đến có tồn tại hay không?
        $view_file = 'views/'.$this->folder.'/'.$file.'.php';
        if(is_file($view_file))
        {
            //Nếu tồn tại file template đó thì tạo ra các biến chứa giá trị truyền vào lúc gọi hàm
            extract($data);
            //sau đó lưu giá trị trả về khi chạy file view template với các dữ liệu đó
            ob_start();
            require_once($view_file);
            $content = ob_get_clean();
            //Kết quả được lưu ở biến content, gọi ra template chung của hệ thống
            require_once('views/layouts/application.php');

        }
    }
}