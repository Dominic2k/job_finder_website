<?php
// app/controllers/jobDescription.php
// session_start();

class jobDescription extends DController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        session_start(); // Gọi session_start() tại đây để sử dụng $_SESSION

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
        // Kiểm tra form submission và các giá trị cần thiết
        if (isset($_POST['submit_application']) && isset($_POST['job_id']) && isset($_POST['user_id'])) {
            $job_id = $_POST['job_id'];  // Lấy job_id từ POST
            $user_id = $_POST['user_id'];  // Lấy user_id từ POST
            $apply_at = date('Y-m-d');  // Lấy ngày nộp đơn
    
            // Kiểm tra và xử lý tệp đính kèm
            if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] == 0) {
                $cv_file = $_FILES['cv_file'];
                $allowed_ext = 'pdf';
                $file_extension = pathinfo($cv_file['name'], PATHINFO_EXTENSION);
    
                // Kiểm tra định dạng tệp
                if ($file_extension !== $allowed_ext) {
                    $data['message'] = 'Chỉ hỗ trợ tệp PDF!';
                    $this->load->view('job_description', $data);  // Trả về trang hiện tại với thông báo
                    return;
                }
    
                // Tạo tên file mới bằng cách thêm user_id vào trước tên file
                $original_file_name = basename($cv_file['name']);  // Lấy tên file gốc
                $file_name = $user_id . '_' . $original_file_name;  // Tạo tên file mới
    
                // Đường dẫn lưu trữ file
                $upload_dir = 'uploads/cvs/';
    
                // Kiểm tra và tạo thư mục nếu chưa tồn tại
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
   
                $file_path = $upload_dir . $file_name;

    
                // Di chuyển file tạm thời vào thư mục uploads
                if (move_uploaded_file($cv_file['tmp_name'], $file_path)) {
                    // Lưu thông tin đơn ứng tuyển vào cơ sở dữ liệu
                    $applicationModel = $this->load->model('applicationModel');
                    $result = $applicationModel->saveApplication($user_id, $job_id, $file_path, $apply_at);
    
                    if ($result) {
                        // Thành công, thông báo và quay lại trang công việc
                        $data['message'] = 'Đơn ứng tuyển của bạn đã được gửi thành công!';
                    } else {
                        $data['message'] = 'Có lỗi xảy ra, vui lòng thử lại!';
                    }
                } else {
                    $data['message'] = 'Không thể tải lên tệp CV!';
                }
            } else {
                $data['message'] = 'Vui lòng đính kèm tệp CV!';
            }
        } else {
            $data['message'] = 'Vui lòng đăng nhập và thử lại!';
        }
        echo addslashes($data['message']);
        // Quay lại trang công việc với job_id và user_id trong URL
        $url = BASE_URL . 'jobDescription?job_id=' . $job_id . '&user_id=' . $user_id;
        header('Location: ' . $url);  // Chuyển hướng về trang công việc
        exit();
    }
}
?>
