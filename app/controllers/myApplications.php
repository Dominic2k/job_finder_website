<?php
// app/controllers/HomeController.php

// session_start();

require 'email_config.php';

class myApplications extends DController {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        session_start();
        $profileModel = $this->load->model('profileModel');
        $applicationModel = $this->load->model('applicationModel');

        $user_id = isset($_SESSION['current']['id']) ? $_SESSION['current']['id'] : 1; // Lấy user_id từ session (hoặc giả sử 1)

        // Lấy thông tin người dùng
        $data['user_info'] = $profileModel->getUserInfo($user_id);

        // Lấy thông tin ứng tuyển của người dùng
        $data['applications'] = $applicationModel->application($user_id);

        $this->load->view('myApplications', $data); // Truyền dữ liệu sang view
    }

    public function updateStatusApplication() {
        session_start();
        $application = $this->load->model('applicationModel');

        $application_id = $_GET['id'];
        $status = $_GET['status'];

        var_dump($application_id); // Kiểm tra giá trị của ID
        var_dump($status);             // Kiểm tra giá trị của status

        $table_application = 'applications';

        $condition = "$table_application.application_id = '$application_id'";
        if ($status == 'accept') {
            $data = array(
                'application_status' => 'Đã chấp nhận'
            );
        }else {
            $data = array(
                'application_status' => 'Đã từ chối'
            );
        }

        var_dump($data); // Kiểm tra xem $data có giá trị đúng không
        var_dump($condition); // Kiểm tra xem điều kiện $condition có hợp lệ không

        $msgUpdateStatusApplication = $application->updateStatusApplication($table_application, $data, $condition);

        $data['application_info'] = $application->getApplicationInfo($application_id); 
        
        
        if (!$data['application_info'] || empty($data['application_info'][0])) {
            die('Dữ liệu từ getApplicationInfo không hợp lệ hoặc rỗng');
        }


        $toEmail = $data['application_info'][0]['email'];
        $toAddress = $data['application_info'][0]['job_location'];
        $fullname = $data['application_info'][0]['fullname'];
        $job_name = $data['application_info'][0]['job_title'];
        $time = date('Y-m-d H:i:s', strtotime('+1 week'));
        
        
        if ($msgUpdateStatusApplication == 1) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Đã chấp nhận ứng viên và gửi thư mời!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Đã từ chối ứng viên!'
            ];
        }


        if ($status == 'accept' && $msgUpdateStatusApplication == 1) {
            sendConfirmationEmail($toEmail, $toAddress, $fullname, $job_name, $time);
        }
        
        header("Location: http://localhost/job_finder_website/recruiter/recruiter");
        exit();
    }

    // public function applyNewJob() {
    //     session_start();
    //     $applicationmodel = $this->load->model('applicationModel');
    //     $table_applications = 'applications';


    //     if (isset($_SESSION['current']) && !empty($_SESSION['current']['user_id'])) {
    //         $user_id = $_SESSION['current']['user_id']; // Lấy user_id từ session
    //     } else {
    //         // Nếu không có session, chuyển hướng đến trang login
    //         header('Location: ' . BASE_URL . '/login');
    //         exit();
    //     }

    //     if (isset($_POST['job_id'])) {
    //         $job_id = $_POST['job_id'];
    //     }
            

    //     if (!isset($_FILES['cv_file']) || $_FILES['cv_file']['error'] !== UPLOAD_ERR_OK) {
    //         die('Lỗi tải lên logo hoặc không có logo được tải lên');
    //     }
    //     $cv = $_FILES['cv_file'];

    //     $data = array(
    //         'cv' => $cv,
    //         'user_id' => $user_id,
    //         'job_id' => $job_id
    //     );

    //     $result = $applicationmodel->applyNewJob($table_applications, $data);

    //     if ($result == 1) {
    //         $_SESSION['flash_message'] = [
    //             'type' => 'success',
    //             'message' => 'Thêm thành công!'
    //         ];
    //     } else {
    //         $_SESSION['flash_message'] = [
    //             'type' => 'error',
    //             'message' => 'Thêm thất bại!'
    //         ];
    //     }
        
    //     header("Location: http://localhost/job_finder_website/");
    //     exit();
    // }

    public function applyNewJob() {
        session_start();
        $applicationmodel = $this->load->model('applicationModel');
        $table_applications = 'applications';
    
        // Kiểm tra session
        if (isset($_SESSION['current']) && !empty($_SESSION['current']['user_id'])) {
            $user_id = $_SESSION['current']['user_id'];
        } else {
            header('Location: ' . BASE_URL . '/login');
            exit();
        }
    
        // Lấy job_id
        if (isset($_POST['job_id'])) {
            $job_id = $_POST['job_id'];
        } else {
            die('Không có thông tin job_id.');
        }
    
        // Kiểm tra file upload
        if (!isset($_FILES['cv_file']) || $_FILES['cv_file']['error'] !== UPLOAD_ERR_OK) {
            die('Lỗi tải lên CV hoặc không có CV được tải lên.');
        }
    
        $cv = $_FILES['cv_file'];
    
        // Kiểm tra loại file và mở rộng
        $allowedExtensions = ['pdf', 'doc', 'docx'];
        $fileExtension = strtolower(pathinfo($cv['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            die('Chỉ chấp nhận các file PDF, DOC, DOCX.');
        }
    
        // Tạo tên file duy nhất
        $newFileName = uniqid('cv_') . '.' . $fileExtension;
    
        // Đường dẫn lưu file
        // $uploadDir = __DIR__ . '/uploads/cv/';
        $uploadDir = __DIR__ . '../public/img/cv/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }
        $destination = $uploadDir . $newFileName;
    
        // Di chuyển file từ thư mục tạm
        if (!move_uploaded_file($cv['tmp_name'], $destination)) {
            die('Lỗi khi di chuyển file.');
        }
    
        // Chuẩn bị dữ liệu lưu vào database
        $data = array(
            'cv' => $newFileName, // Lưu tên file mới
            'user_id' => $user_id,
            'job_id' => $job_id
        );
    
        // Gọi model để thêm dữ liệu
        $result = $applicationmodel->applyNewJob($table_applications, $data);
    
        // Xử lý kết quả
        if ($result == 1) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Thêm thành công!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Thêm thất bại!'
            ];
        }
    
        header("Location: " . BASE_URL);
        exit();
    }
    
}
