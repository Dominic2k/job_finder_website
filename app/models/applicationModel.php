<?php 

class applicationModel extends DModel {
    public function __construct() {
        parent::__construct();
    }

    public function application($user_id) {
        $sql = "SELECT companies.*, jobs.*, applications.*
                FROM applications
                JOIN jobs ON applications.job_id = jobs.job_id
                JOIN users ON jobs.user_id = users.user_id
                JOIN companies ON users.user_id = companies.user_id
                WHERE applications.user_id = :user_id";
        
        $data = [':user_id' => $user_id];
        return $this->db->select($sql, $data); // 
    }

    public function saveApplication($user_id, $job_id, $cv_file, $apply_at) {
        // Dữ liệu cần thêm vào bảng applications
        $data = [
            'user_id' => $user_id,
            'job_id' => $job_id,
            'apply_at' => $apply_at,
            'application_status' => 'pending', // Mặc định trạng thái là 'pending'
            'cv' => $cv_file
        ];

        // Gọi phương thức insert từ lớp Database để thêm đơn ứng tuyển vào bảng applications
        return $this->db->insert('applications', $data);
    }

    public function updateStatusApplication($table_applications, $data, $condition) {
        return $this->db->update($table_applications, $data, $condition);
    }

    public function getApplicationInfo($application_id) {
        $sql = "SELECT 
                u.full_name AS fullname,
                u.email AS email,
                j.job_title,
                j.job_location
            FROM 
                applications a
            JOIN 
                users u ON a.user_id = u.user_id
            JOIN 
                jobs j ON a.job_id = j.job_id
            WHERE 
                a.application_id = :application_id;";
        $data = [':application_id' => $application_id];
        return $this->db->select($sql, $data);
    }
}

?>