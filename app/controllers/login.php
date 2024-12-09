<?php
session_start();

class login extends DController {
    public function __construct() {
        parent::__construct();
    }
    public function login(){
        $model=$this->load->model('loginModel');
        $data['user']=$model->getUser();
        if(isset($_POST['logIn'])){
            foreach($data['user'] as $value){
                if($value['email']==$_POST['rg-email']&&$value['password']==md5($_POST['rg-password'])){
                    $_SESSION['current']=$value;
                    print_r($_SESSION['current']);
                    if($value['role']==3){
                        //link đến trang chủ mặc định
                        header('Location: http://localhost/job_finder_website/');
                        exit();
                    }else if($value['role']==2){
                        header('Location: http://localhost/job_finder_website/recruiter/recruiter');
                        //link đến trang dashboard của nhà tuyển dụng
                    }
                    // đổi link??? ???
                }else{
                }
            }

            // Thông báo lỗi nếu không tìm thấy tài khoản hợp lệ
            echo("<script>alert('Không tìm thấy tài khoản hợp lệ!');</script>");
            unset($_POST['logIn']);
        }

        // Hiển thị trang login
        $this->load->view('login');
    }
}
?>
