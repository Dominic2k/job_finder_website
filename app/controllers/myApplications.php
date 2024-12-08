<?php
// app/controllers/HomeController.php
require 'email_config.php';
class myApplications extends DController {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $profileModel = $this->load->model('profileModel');
        $applicationModel = $this->load->model('applicationModel');
        
        $user_id = 1;

        // Lấy thông tin từ model
        $data['user_info'] = $profileModel->getUserInfo($user_id); 
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
}