<?php
session_start();
class myProfile extends DController {
    public function __construct() {
        parent::__construct();
    }

    // Hiển thị trang thông tin cá nhân
    public function myProfile() {
        $profileModel = $this->load->model('profileModel');
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $_SESSION['current']['user_id'];

        // Lấy thông tin từ model
        $user_info = $profileModel->getUserById($user_id);
        if (!$user_info) {
            header('Location: ' . BASE_URL . '/login');
            exit();
        }
        $_SESSION['current'] = $user_info;
        $this->load->view('myProfile', ['user' => $user_info]); // Truyền dữ liệu sang view
    }

    // Cập nhật thông tin cá nhân
   public function updateProfile() {
        if (!isset($_SESSION['current'])) {
            header('Location: ' . BASE_URL . '/login');
            exit();
        }
       
        $profileModel = $this->load->model('profileModel');
        $user_id = $_SESSION['current']['user_id']; // Lấy user_id từ session

    
        // Dữ liệu cần cập nhật
        $data = [
            'full_name' => $_POST['fullname'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'date_of_birth' => $_POST['birthday'],
            'gender' => $_POST['gender']
        ];
    
        // Kiểm tra nếu có ảnh tải lên
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            // Lấy tên tệp và mở rộng của tệp
            $avatar_tmp = $_FILES['avatar']['tmp_name'];
            $avatar_name = $_FILES['avatar']['name'];
            $avatar_extension = pathinfo($avatar_name, PATHINFO_EXTENSION);
    
            // Tạo tên mới cho ảnh để tránh trùng lặp
            $avatar_new_name = "avatar_" . $user_id . "." . $avatar_extension;
            $avatar_path = "public/img/" . $avatar_new_name;
    
            // Nếu có ảnh cũ, xóa ảnh cũ
            if (isset($_SESSION['current']['avatar']) && file_exists($_SESSION['current']['avatar'])) {
                unlink($_SESSION['current']['avatar']); // Xóa ảnh cũ
            }
    
            // Di chuyển tệp ảnh vào thư mục public/img
            if (move_uploaded_file($avatar_tmp, $avatar_path)) {
                // Cập nhật đường dẫn ảnh mới vào data
                $data['avatar'] = $avatar_path;
            }
        }
    
        // Cập nhật thông tin người dùng trong database
        $result = $profileModel->updateUserInfo($data, $user_id);
    
        if ($result) {
            $_SESSION['current']['full_name'] = $data['full_name']; 
            $_SESSION['current']['phone'] = $data['phone'];  // Cập nhật số điện thoại
            $_SESSION['current']['email'] = $data['email'];  // Cập nhật email
            $_SESSION['current']['date_of_birth'] = $data['date_of_birth'];  // Cập nhật ngày sinh
            $_SESSION['current']['gender'] = $data['gender'];  // Cập nhật giới tính
    
    // Cập nhật ảnh đại diện nếu có
            $_SESSION['current']['avatar'] = isset($data['avatar']) ? $data['avatar'] : $_SESSION['current']['avatar'];

            $message['msg'] = "Cập nhật thông tin thành công!";
        } else {
            $message['msg'] = "Cập nhật thông tin thất bại!";
}

// Truyền lại thông tin và thông điệp đến view
$data['user'] = $_SESSION['current'];
$data['message'] = $message;

$this->load->view('myProfile', $data);
    }
    public function logout() {
        // Hủy session
        session_start();
        session_unset();
        session_destroy();

        // Chuyển hướng về trang homepage
        header("Location: " . BASE_URL);
        exit();
    }
}
?>
