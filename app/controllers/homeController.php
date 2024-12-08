<?php
// app/controllers/HomeController.php
// require_once './app/models/industryModel.php';

class homepage extends DController {
    public function __construct() {
        parent::__construct();
    }
    
    //Phương thức index để hiển thị trang chủ
    public function index() {
        $industryModel = $this->load->model('industryModel');
    
        // Lấy danh sách ngành từ model
        $industries = $industryModel->getIndustries();
    
        // Kiểm tra nếu danh sách ngành không rỗng
        if (!empty($industries)) {
            // Tính số lượng công việc cho từng ngành
            foreach ($industries as &$industry) {
                if (isset($industry['industry_id'])) {
                    // Gọi hàm countJobsByIndustry để lấy số lượng công việc của từng ngành
                    $industry['job_count'] = $industryModel->countJobsByIndustry($industry['industry_id']);
                }
            }
    
            // Sắp xếp các ngành theo số lượng công việc giảm dần
            usort($industries, function($a, $b) {
                return $b['job_count'] - $a['job_count'];  // Sắp xếp theo job_count giảm dần
            });
    
            // Lấy 8 ngành đầu tiên
            $industries = array_slice($industries, 0, 8);
        } else {
            echo "No industries found!";
        }
    
        // Truyền dữ liệu ngành vào view
        $data['industries'] = $industries;
    
        // Gọi hàm getJobs để lấy danh sách công việc mới nhất
        $jobModel = $this->load->model('jobModel');
        $getJobs = $jobModel->getJobs();
        $data['getJobs'] = $getJobs;
    
        // Load view homepage và truyền dữ liệu ngành
        $this->load->view('homepage', $data);
    }

    public function notfound() {
        $this->load->view('404');
    }
}
?>