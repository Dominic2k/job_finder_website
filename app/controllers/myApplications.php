<?php
// app/controllers/HomeController.php

class myApplications extends DController {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $profileModel = $this->load->model('profileModel');
        $applicationModel = $this->load->model('applicationModel');
        
        $user_id = 1; // Giả sử ID người dùng hiện tại là 1

        // Lấy thông tin từ model
        $data['user_info'] = $profileModel->getUserInfo($user_id); 
        $data['applications'] = $applicationModel->application($user_id); 
        
        $this->load->view('myApplications', $data); // Truyền dữ liệu sang view
    }


    public function updateStatusApplication() {
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

        if($msgUpdateStatusApplication == 1) {
            echo "Cập nhật thành công!";
            header("Location: http://localhost/job_finder_website/recruiter/recruiter");
            exit();
        }else {
            echo 'Cập nhật thất bại'; 
        }

    }
}

?>