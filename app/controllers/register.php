<?php
session_start();
class register extends DController{
    public function __construct(){
        $data=array();
        parent::__construct();
    }
    public function registerUser(){
        unset($_SESSION['loadCompany']);unset($_SESSION['loadData']);
        $data['check']="1";
        $model=$this->load->model('registerModel');
        $data['user']=$model->getUser();
        extract($data);
        if(isset($_POST['register1'])){
            foreach($user as $value){
                if($value['email']==$_POST['rg-email']){
                    unset($_POST['register1']);
                    break;
                }else{
                    
                }
            }
            //Nếu tồ tại nghĩa là email không trùng
            if(isset($_POST['register1'])){
                //Tạo tài khoản với các giá trị name, phone, email, và password và "vai trò :rule"trên form đang ký(Phương thức addUser(...))
                $model->addUser($_POST['rg-fullname'],$_POST['rg-phone'],$_POST['rg-email'],$_POST['rg-password'],3);
                header('Location: ?url=login/login');
            }else{
                unset($_POST['rg-fullname']);unset($_POST['rg-phone']);unset($_POST['rg-email']);unset($_POST['rg-password']);
                echo("<script>alert('Email đã tồn tại!');</script>");
            }
        }
        $this->load->view('register',$data);
    }
    public function registerCompany1(){
        $data['check']="2";
        $model=$this->load->model('registerModel');
        $data['user']=$model->getUser();
        if(isset($_POST['register2'])){
            print_r($data['user']);
            foreach($data['user'] as $value){
                if($value['email']==$_POST['rg-email']){
                    unset($_POST['register2']);
                    break;
                }else{
                }
            }
            //Nếu tồ tại nghĩa là email không trùng
            if(isset($_POST['register2'])){
                //Lưu các giá trị name, phone, email, và password trên form đang ký(Phương thức addUser(...))
                $_SESSION['loadData']=[$_POST['rg-fullname'],$_POST['rg-phone'],$_POST['rg-email'],$_POST['rg-password']];
                header('Location: ?url=register/registerCompany2');
                exit();
            }else{
                unset($_POST['rg-fullname']);unset($_POST['rg-phone']);unset($_POST['rg-email']);unset($_POST['rg-password']);unset($_SESSION['loadData']);unset($_SESSION['loadCompany']);
                echo("<script>alert('Email đã tồn tại!');</script>");
            }
        }
        $this->load->view('register',$data);
    }
    //
    public function registerCompany2(){
        $data['check']="3";
        $model=$this->load->model('registerModel');
        $data['user']=$model->getUser();
        $data['company']=$model->getCompany();
        $data['industry']=$model->getIndustry();
        if(isset($_POST['register3'])){
            foreach($data['company'] as $value){
                if($value['comp_name']==$_POST['rg-companyName']){
                    unset($_POST['register3']);
                    break;
                }else{
                }
            }
            //Nếu tồ tại nghĩa là email không trùng
            if(isset($_POST['register3'])){
                //Thêm user với biến session và rule:2
                $model->addUser($_SESSION['loadData'][0],$_SESSION['loadData'][1],$_SESSION['loadData'][2],$_SESSION['loadData'][3],2);
                //Tìm id company và id user
                $data['user']=$model->getUser();
                foreach($data['user'] as $value){
                    if($value['email']==$_SESSION['loadData'][2]){
                        $idUser=$value['user_id'];
                    }
                }
                //Thêm company với các giá trị name, phone, email, và password trên form đang ký và id_user của người vừa đăng ký(Phương thức addUser(...))
                $model->addCompany($_POST['rg-companyName'],$_POST['rg-companyIndustry'],$_POST['rg-companyAdress'],$idUser);
                unset($_SESSION['loadData']);
                unset($_SESSION['loadCompany']);
                header('Location: ?url=login/login');
                exit();
            }else{
                unset($_POST['rg-companyName']);unset($_POST['rg-companyIndustry']);unset($_POST['rg-companyAdress']);
                echo("<script>alert('Tên công ty đã tồn tại!');</script>");
            }
        }else if(isset($_POST['registerBack2'])){
            $_SESSION['loadCompany']=[$_POST['rg-companyName'],$_POST['rg-companyIndustry'],$_POST['rg-companyAdress']];
            header('Location: ?url=register/registerCompany1');
            exit();
        }
        //print_r($data);
        $this->load->view('register',$data);
    }
}
?>