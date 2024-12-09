<?php
// app/controllers/jobDescription.php
session_start();

class jobDescription extends DController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // session_start(); // Gọi session_start() tại đây để sử dụng $_SESSION

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (isset($_SESSION['current']) && !empty($_SESSION['current']['user_id'])) {
            $user_id = $_SESSION['current']['user_id']; // Lấy user_id từ session
        } else {
            // Nếu không có session, chuyển hướng đến trang login
            header('Location: ' . BASE_URL . '/login');
            exit();
        }

        // Kiểm tra nếu có 'job_id' trong URL
        if (isset($_GET['job_id'])) {
            $job_id = $_GET['job_id'];

            // Load model jobmodel để lấy thông tin công việc
            $jobModel = $this->load->model('jobmodel');
            $job = $jobModel->getJobById($job_id); // Lấy thông tin công việc theo job_id

            if ($job) {
                $industry_id = $job[0]['industry_id']; // Lấy industry_id của công việc
                $data['job'] = $job[0];
                   
                // Gọi hàm getSimilarJobs để lấy các công việc cùng ngành nghề
                $similarJobs = $jobModel->getSimilarJobs($industry_id);
                $data['similarJobs'] = $similarJobs;
            } else {
                $data['error'] = "No job found!";
            }
        } else {
            $data['error'] = "No job selected!";
        }

        // Lấy thông tin người dùng từ database
        $profileModel = $this->load->model('profileModel');
        $data['user_info'] = $profileModel->getUserInfo($user_id);

        // Load view jobDescription và truyền dữ liệu công việc và thông tin người dùng
        $this->load->view('jobDescription', $data);
    }

    // Phương thức xử lý việc nộp đơn ứng tuyển
    public function submitApplication() {
        // Kiểm tra nếu user_id và job_id có trong URL
        if (!isset($_GET['job_id']) || !isset($_SESSION['current']['user_id'])) {
            echo "Vui lòng đăng nhập và chọn công việc để ứng tuyển!";
            exit();
        }
    
        $job_id = $_GET['job_id'];
        $user_id = $_SESSION['current']['user_id'];  // Lấy user_id từ session
    
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!isset($_SESSION['current']) || $_SESSION['current']['user_id'] != $user_id) {
            echo "Vui lòng đăng nhập và chọn công việc để ứng tuyển!";
            exit();
        }
    
        // Kiểm tra nếu có file CV được tải lên và nó có đúng định dạng PDF
        if (isset($_FILES['cv_file']) && $_FILES['cv_file']['type'] == 'application/pdf') {
            $cvFile = $_FILES['cv_file'];
    
            // Xác định thư mục lưu trữ file CV
            $uploadDir = 'public/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);  // Tạo thư mục nếu chưa tồn tại
            }
    
            // Đặt tên cho file dựa trên ID người dùng và thời gian để tránh trùng lặp
            $fileName = 'cv_' . $user_id . '_' . time() . '.pdf';
            $filePath = $uploadDir . $fileName;
    
            // Di chuyển file từ thư mục tạm vào thư mục lưu trữ
            if (move_uploaded_file($cvFile['tmp_name'], $filePath)) {
                // Nếu file tải lên thành công, lưu thông tin vào cơ sở dữ liệu
    
                // Load model ApplicationModel để lưu đơn ứng tuyển
                $applicationModel = $this->load->model('applicationModel');
    
                // Chuẩn bị dữ liệu cần lưu vào bảng applications
                $data = [
                    'user_id' => $user_id,
                    'job_id' => $job_id,
                    'apply_at' => date('Y-m-d'),  // Lấy ngày hiện tại
                    'application_status' => 'pending',  // Mặc định là 'pending'
                    'cv' => $fileName  // Lưu tên file CV đã tải lên
                ];
    
                // Lưu đơn ứng tuyển vào cơ sở dữ liệu
                $isCreated = $applicationModel->createApplication($data);
    
                if ($isCreated) {
                    // Đơn ứng tuyển đã được nộp thành công, chuyển hướng đến trang hồ sơ ứng tuyển
                    header('Location: ' . BASE_URL . '/myApplications');
                    exit();
                } else {
                    // Thông báo lỗi nếu không thể lưu vào cơ sở dữ liệu
                    echo "Có lỗi khi nộp đơn. Vui lòng thử lại!";
                    exit();
                }
            } else {
                // Thông báo lỗi nếu không thể tải lên file CV
                echo "Có lỗi khi tải lên file CV. Vui lòng thử lại!";
                exit();
            }
        } else {
            // Nếu không có file CV hoặc file không phải định dạng PDF
            echo "Vui lòng tải lên file CV dưới dạng PDF.";
            exit();
        }
    }
    
    
    
}
?>
