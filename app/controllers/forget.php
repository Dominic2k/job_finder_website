<?php
session_start();
class forget  extends DController{
    public function __construct(){
        $data=array();
        parent::__construct();
    }
    public function forget(){
        $model=$this->load->model('forgetmodel');
        $data['user']=$model->getUser();
        $data['check']=1;
        if(isset($_POST['forget'])){
            foreach($data['user'] as $value){
                if($value['email']==$_POST['rg-email']){
                    $_SESSION['de_email']= $_POST['rg-email'];
                    $data['check']=2;
                    $_SESSION['user_fo']=$value;
                    include_once 'public/mail/sendmail.php';
                    unset($_POST['forget']);
                }else{
                }
            }
            if(!isset($_POST['forget'])){
                ?>
                    <script type="text/javascript">
                        window.location = 'http://localhost/job_finder_website/forget/forget2';
                    </script>
                <?php
            } else{
                echo("<script>alert('Không tìm thấy tài khoản hợp lệ!');</script>");
            }
        }
        $this->load->view('forget',$data);
    }
    public function forget2(){
        $model=$this->load->model('forgetmodel');
        $data['user']=$model->getUser();
        $data['check']=2;
        if(isset($_POST['forget2'])){
            $codel=$_SESSION['e_code'];
            if($codel==$_POST['code']){
                $model->updatePass($_SESSION['user_fo']['user_id'],md5($_POST['de_pass']));
                unset($_SESSION['de_email']);
                unset($_SESSION['e_code']);
                header('Location: ?url=login/login');
                exit();
            }else{
                $data['check']=2;
                echo("<script>alert('Nhập sai mã!');</script>");
            }
        }
        $this->load->view('forget',$data);
    }
}
?>