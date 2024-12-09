<?php
// app/controllers/HomeController.php

// app/controllers/HomeController.php
session_start();
class myApplications extends DController {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $profileModel = $this->load->model('profileModel');
        $applicationModel = $this->load->model('applicationModel');

        $user_id = isset($_SESSION['current']['id']) ? $_SESSION['current']['id'] : 1; // Lấy user_id từ session (hoặc giả sử 1)

        // Lấy thông tin người dùng
        $data['user_info'] = $profileModel->getUserInfo($user_id);

        // Lấy thông tin ứng tuyển của người dùng
        $data['applications'] = $applicationModel->application($user_id);

        $this->load->view('myApplications', $data); // Truyền dữ liệu sang view
    }
}


?>