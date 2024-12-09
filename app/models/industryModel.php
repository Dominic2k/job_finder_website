<?php 

class industryModel extends DModel {

    public function __construct() {
        parent::__construct();
    }

    public function industry() {
        $sql = "select * from industries";
        return $this->db->select($sql);
    }

    public function countJobsByIndustry($industry_id) {
        $sql = "SELECT COUNT(*) AS total_jobs
                FROM jobs
                JOIN users ON jobs.user_id = users.user_id
                JOIN companies ON users.user_id = companies.user_id
                JOIN industries ON companies.industry_id = industries.industry_id
                WHERE industries.industry_id = :industry_id";
        $data = [':industry_id' => $industry_id]; // Dữ liệu cần truyền vào
        $result = $this->db->select($sql, $data); // Thực hiện truy vấn
        return $result ? $result[0]['total_jobs'] : 0; // Trả về số lượng công việc
    }
    
    public function getIndustries() {
        // Lấy danh sách ngành
        $sql = "SELECT industry_id, industry_name FROM industries";
        $industries = $this->db->select($sql); // Trả về mảng các ngành
    
        // Duyệt qua từng ngành và gọi hàm countJobsByIndustry
        // foreach ($industries as &$industry) {
        //     // Gọi hàm countJobsByIndustry để lấy số lượng công việc cho mỗi ngành
        //     $industry['total_jobs'] = $this->countJobsByIndustry($industry['industry_id']);
        // }
    
        return $industries; // Trả về mảng ngành với số lượng công việc
    }
    
}
?>