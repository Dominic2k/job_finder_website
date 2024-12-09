<?php
session_start();

class login extends DController {
    public function __construct() {
        parent::__construct();
    }

    public function login() {
        $model = $this->load->model('loginModel');
        $data['user'] = $model->getUser();

        if (isset($_POST['logIn'])) {
            foreach ($data['user'] as $value) {
                if ($value['email'] == $_POST['rg-email'] && $value['password'] == md5($_POST['rg-password'])) {
                    // Đưa thông tin người dùng vào session
                    $_SESSION['current'] = [
                        'user_id' => $value['user_id'], 
                        'email' => $value['email'], 
                        'full_name' => $value['full_name'], 
                        'phone' => $value['phone'], 
                        'avatar' => $value['avatar'],
                        'role' => $value['role']
                    ];

                    // In thông tin session (chỉ để kiểm tra, có thể xóa sau)
                    print_r($_SESSION['current']);

                    // Chuyển hướng về trang homepage sau khi đăng nhập
                    header('Location: ' . BASE_URL);
                    exit();
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
