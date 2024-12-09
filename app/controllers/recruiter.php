<?php
class recruiter extends DController{
        public function __construct() {
        $data = array();
        $message = array();
        
        parent::__construct();
    }

    public function list_job() {
        $this->load->view('header');

        $jobmodel = $this->load->model('jobmodel');
        $table_jobs = 'jobs';
        $data['job'] = $jobmodel->job($table_jobs);

        $this->load->view('job', $data);
        $this->load->view('footer');
    }

    public function recruiter() {
        session_start();
        if (!isset($_SESSION['current'])) {
            die("Session current is not set.");
        }
        if (!isset($_SESSION['current']['user_id'])) {
            die("Session current['id'] is not set.");
        }
        if (isset($_SESSION['current']['role'])) {
            if ($_SESSION['current']['role'] == 3 or $_SESSION['current']['role'] == 1) {
                # code...
                die("You are not recruiter");
            }
        }

        $jobmodel = $this->load->model('jobmodel');
        $company = $this->load->model('company');
        $recruitermodel = $this->load->model('recruitermodel');


        $table_jobs = 'jobs';
        $table_users = 'users';
        $company_id = 1;
        if (isset($_SESSION['current']['user_id'])) {
            $user_id = $_SESSION['current']['user_id'];
        }
        $table_company = 'companies';

        $data['countjob'] = $jobmodel->countjob($table_jobs, $user_id);
        
        $data['list_all_job'] = $jobmodel->list_all_job($table_jobs, $user_id);
        $data['list_company'] = $company->list_company($table_company, $company_id);
        $data['topthreejob'] = $jobmodel->topthreejob($table_jobs, $user_id);   
        $data['userbyid'] = $recruitermodel->userbyid($table_users, $user_id);
        
        $this->load->view('recruiter', $data);
    }
    
    public function userProfile() {
        session_start();

        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (isset($_SESSION['current']['id'])) {
            $id = $_SESSION['current']['id'];
            $recruitermodel = $this->load->model('recruitermodel');
            
            $table_users = 'users';
            $data['userbyid'] = $recruitermodel->userbuid($table_users, $id);




        } else {
            // Điều hướng đến trang đăng nhập nếu chưa đăng nhập
            header("Location: login.php");
            exit();
        }
    }

    public function jobbyid() {
        session_start();
        $id = $_GET['id'];
        if (isset($_SESSION['current']['user_id'])) {
            $user_id = $_SESSION['current']['user_id'];
        }
        $jobmodel = $this->load->model('jobmodel');
        $recruitermodel = $this->load->model('recruitermodel');
        $table_jobs = 'jobs';
        $table_users = 'users';
        $data['jobbyid'] = $jobmodel->jobbyid($table_jobs, $id);
        $data['userbyid'] = $recruitermodel->getUserById($table_users, $user_id);
        $this->load->view('applicant_list', $data);
    }
    public function applicantbyid() {
        session_start();

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        if($_GET['id'] == "") {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Không có ứng viên để hiển thị!'
            ];
            header("Location: http://localhost/job_finder_website/recruiter/recruiter");
            exit();
        }

        if (isset($_SESSION['current']['user_id'])) {
            $user_id = $_SESSION['current']['user_id'];
        }else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Truy cập thất bại!'
            ];
            header("Location: http://localhost/job_finder_website/recruiter/recruiter");
            exit();
        }

        $jobmodel = $this->load->model('jobmodel');
        $recruitermodel = $this->load->model('recruitermodel');
        $table_jobs = 'jobs';
        $table_users = 'users';

        $data['applicantbyid'] = $jobmodel->applicantbyid($table_jobs, $id);
        $data['userbyid'] = $recruitermodel->getUserById($table_users, $user_id);

        $this->load->view('applicant_detail', $data);
    }  

    public function insertjob() {
        session_start();
        $jobmodel = $this->load->model('jobmodel');
        $table_jobs = 'jobs';

        $job_title = $_POST['job_title'];
        $job_status = $_POST['job_status'];
        $job_description = $_POST['job_description'];
        $job_responsibilities = $_POST['job_responsibilities'];
        $job_requirements = $_POST['job_requirements'];
        $job_location = $_POST['job_location'];
        $job_benefit = $_POST['job_benefit'];
        $job_salary = $_POST['job_salary'];
        $job_posted_date = $_POST['job_posted_date'];
        $job_deadline = $_POST['job_deadline'];
        $job_required_candidates = $_POST['job_required_candidates'];
        $job_total_applied = $_POST['job_total_applied'];
        $job_type_id = $_POST['job_type_id'];
        $level_id = $_POST['level_id'];
        $user_id = $_POST['user_id'];


        $data = array(
            'user_id' => $user_id,
            'job_title' => $job_title,
            'job_type_id' => $job_type_id,
            'job_status' => $job_status,
            'level_id' => $level_id,
            'job_description' => $job_description,
            'job_responsibilities' => $job_responsibilities,
            'job_requirements' => $job_requirements,
            'job_location' => $job_location,
            'job_benefit' => $job_benefit,
            'job_salary' => $job_salary,
            'job_posted_date' => $job_posted_date,
            'job_deadline' => $job_deadline,
            'job_required_candidates' => $job_required_candidates,
            'job_total_applied' => $job_total_applied
        );

        $result = $jobmodel->insertjob($table_jobs, $data);

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
        
        header("Location: http://localhost/job_finder_website/recruiter/recruiter");
        exit();
    }

    public function updatecompany() {
        session_start();
        if (!isset($_FILES['comp_logo']) || $_FILES['comp_logo']['error'] !== UPLOAD_ERR_OK) {
            die('Lỗi tải lên logo hoặc không có logo được tải lên');
        }
    
        $company = $this->load->model('company');
        $table_companies = 'companies';
        $comp_id = $_POST['comp_id'];
    
        $comp_name = $_POST['comp_name'];
        $comp_logo = $_FILES['comp_logo'];
        $comp_website = $_POST['comp_website'];
        $comp_address = $_POST['comp_address'];
        $employee_count = $_POST['employee_count'];
        $comp_benefit = $_POST['comp_benefit'];
        $industry_id = $_POST['industry_id'];
        $founded_date = $_POST['founded_date'];
        $comp_description = $_POST['comp_description'];
        $user_id = $_POST['user_id'];
    
        // Thư mục đích để lưu logo
        $uploadDir = 'public/img/'; // Đảm bảo thư mục này tồn tại và có quyền ghi
    
        // Tạo tên file mới để tránh trùng lặp
        $fileName = uniqid() . '-' . basename($comp_logo['name']);
        $uploadPath = $uploadDir . $fileName;
    
        // Kiểm tra và di chuyển file từ thư mục tạm
        if (move_uploaded_file($comp_logo['tmp_name'], $uploadPath)) {
            // Nếu thành công, lưu đường dẫn file vào cơ sở dữ liệu
            $logoPath = $uploadPath;
        } else {
            die('Không thể lưu logo vào thư mục đích');
        }
    
        // Dữ liệu cập nhật
        $condition = "$table_companies.comp_id = '$comp_id'";
        $data = array(
            'comp_name' => $comp_name,
            'comp_logo' => $logoPath, // Lưu đường dẫn ảnh vào DB
            'comp_website' => $comp_website,
            'comp_address' => $comp_address,
            'employee_count' => $employee_count,
            'comp_benefit' => $comp_benefit,
            'industry_id' => $industry_id,
            'founded_date' => $founded_date,
            'comp_description' => $comp_description,
            'user_id' => $user_id
        );
    
        // Gọi hàm update
        $msgUpdateCompany = $company->updatecompany($table_companies, $data, $condition);
        
        if ($msgUpdateCompany == 1) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Cập nhật thành công!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Cập nhật thất bại!'
            ];
        }
        header("Location: http://localhost/job_finder_website/recruiter/recruiter");
        exit();
    }

    public function logout() {
        session_start(); // Đảm bảo gọi session_start() ở đầu file PHP
        session_unset();
        session_destroy();

        header('Location: http://localhost/job_finder_website/');
        exit();

    }

    public function deletejob() {
        session_start();
        $jobmodel = $this->load->model('jobmodel');
        $table_jobs = 'jobs';

        $id = $_GET['id'];

        $condition ="job_id = $id";


        $result = $jobmodel->deletejob($table_jobs, $condition);
        
        if ($result == 1) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Xoá thành công!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Xoá thất bại!'
            ];
        }
        header("Location: http://localhost/job_finder_website/recruiter/recruiter");
        exit();
    }
}
