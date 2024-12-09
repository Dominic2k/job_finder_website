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
    public function getApplicationsByUser($user_id) {
        $sql = "SELECT * FROM applications WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createApplication($data) {
        // Lưu thông tin vào bảng applications
        $query = "INSERT INTO applications (user_id, job_id, apply_at, application_status, cv) 
                  VALUES (:user_id, :job_id, :apply_at, :application_status, :cv)";
        
        $params = [
            'user_id' => $data['user_id'],
            'job_id' => $data['job_id'],
            'apply_at' => $data['apply_at'],
            'application_status' => $data['application_status'],
            'cv' => $data['cv']
        ];

        // Thực thi câu lệnh SQL và trả về true nếu thành công
        $result = $this->db->insert($query, $params);

        return $result;
    }
    // Hàm cập nhật trạng thái đơn ứng tuyển
    public function updateApplicationStatus($application_id, $status) {
        $db = $this->db;
        
        // Cập nhật trạng thái
        $query = "UPDATE applications SET application_status = :application_status WHERE application_id = :application_id";
        
        // Dữ liệu đầu vào
        $data = [
            ':application_status' => $status,
            ':application_id' => $application_id
        ];

        return $db->select($query, $data); // Thực thi câu lệnh UPDATE
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
