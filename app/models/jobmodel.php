<?php 

class jobmodel extends DModel {

    public function __construct() {
        parent::__construct();
    }
    // public function job($table_jobs) {
    //     $sql = "select * from " . $table_jobs;
    //     return $this->db->select($sql);
    // }

    public function countjob($table_jobs, $id) {
        $sql = "SELECT 
                    u.user_id AS recruiter_id,
                    u.full_name AS recruiter_name,
                    COUNT(DISTINCT j.job_id) AS total_jobs_posted,
                    SUM(CASE WHEN a.application_status = 'Đã từ chối' THEN 1 ELSE 0 END) AS total_rejected,
                    SUM(CASE WHEN a.application_status = 'Đã chấp nhận' THEN 1 ELSE 0 END) AS total_accepted,
                    SUM(CASE WHEN a.application_status = 'Chờ xử lí' THEN 1 ELSE 0 END) AS total_pending
                FROM 
                    users u
                LEFT JOIN 
                    $table_jobs j ON u.user_id = j.user_id
                LEFT JOIN 
                    applications a ON j.job_id = a.job_id
                WHERE 
                    u.user_id = :id";
                $data = [':id' => $id];
        return $this->db->select($sql, $data);
    }

    public function list_all_job($table_jobs, $id) {
        $sql = "
                SELECT 
                    j.*, 
                    jt.job_type_name AS Job_Type, 
                    COUNT(a.application_id) AS Accepted_Applicants
                FROM $table_jobs j
                JOIN job_types jt ON j.job_type_id = jt.job_type_id
                LEFT JOIN applications a ON j.job_id = a.job_id
                WHERE j.user_id = :user_id
                GROUP BY j.job_id, jt.job_type_name
                ORDER BY j.job_posted_date DESC;
            ";
        $data = [':user_id' => $id];

        return $this->db->select($sql, $data);
    }
    

    public function topthreejob($table_jobs, $id) {
        $sql = "
                SELECT j.*
                FROM $table_jobs j
                inner JOIN users u ON j.user_id = u.user_id
                WHERE j.user_id = :user_id
                ORDER BY j.job_deadline ASC
                LIMIT 3;
            ";

        $data = [':user_id' => $id];

        return $this->db->select($sql, $data);
    }

    public function topnewjob($table_jobs) {
        $sql = "SELECT *
                FROM jobs
                ORDER BY job_posted_date DESC
                LIMIT 8;
                ";
        return $this->db->select($sql);
    }
    public function getJobs() {
        $sql = "
            select companies.industry_id, jobs.job_id, jobs.job_title, companies.comp_name, companies.comp_address, companies.comp_logo, job_types.job_type_name
            from jobs
            join job_types on jobs.job_type_id = job_types.job_type_id
            join users on jobs.user_id = users.user_id
            join companies on users.user_id = companies.user_id
            order by jobs.job_posted_date desc
            limit 8
        ";
        return $this->db->select($sql);
    }

    public function getSimilarJobs($industry_id) {
        $sql = "
            SELECT companies.industry_id, jobs.job_title, companies.comp_name, companies.comp_address, companies.comp_logo, job_types.job_type_name
            FROM jobs
            JOIN job_types ON jobs.job_type_id = job_types.job_type_id
            JOIN users ON jobs.user_id = users.user_id
            JOIN companies ON users.user_id = companies.user_id
            WHERE companies.industry_id = :industry_id -- Lọc theo industry_id
        ";
    
        $data = [':industry_id' => $industry_id];  // Dữ liệu cần truyền vào
        return $this->db->select($sql, $data);

    }

    // Trong file jobmodel.php

public function getJobById($job_id) {
    // Viết câu SQL để lấy công việc theo job_id
    $sql = "SELECT jobs.*, companies.*, job_types.*
            FROM jobs
            JOIN users ON jobs.user_id = users.user_id
            JOIN companies ON users.user_id = companies.user_id
            JOIN job_types ON jobs.job_type_id = job_types.job_type_id
            WHERE jobs.job_id = :job_id LIMIT 1";
    $data = [':job_id' => $job_id];

    // Thực thi truy vấn và trả về kết quả
    return $this->db->select($sql, $data);
}

     
    // public function jobbyid($table_jobs, $id) {
    //     $sql = "select * from " . $table_jobs . " where job_id =:id";
    
    //     $data = array(':id' => $id);
    
    //     return $this->db->select($sql, $data);
    // }

    // public function userbyid($table_users, $id) {
    //     if (!is_numeric($id)) {
    //         throw new Exception("Invalid ID");
    //     }
    //     $sql = "SELECT users.full_name, users.email, users.phone 
    //             FROM $table_users 
    //             WHERE $table_users.user_id = :id";
    //     $data = [':id' => $id];
    
    //     // Debug
    //     $result = $this->db->select($sql, $data);
    //     if (empty($result)) {
    //         die("Không có thông tin người dùng trong database.");
    //     }
    
    //     return $result;
    // }

    public function jobbyid($table_jobs, $id) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid ID");
        }
        $sql = "SELECT 
                j.*,
                a.application_status AS application_status,
                a.application_id AS application_id,
                u.full_name AS applicant_name,
                a.apply_at AS application_date,
                jt.*,
                COUNT(a.application_id) OVER (PARTITION BY j.job_id) AS total_applicants
                FROM 
                $table_jobs j
                left JOIN applications a ON j.job_id = a.job_id
                LEFT JOIN users u ON a.user_id = u.user_id
                LEFT JOIN job_types jt ON j.job_type_id = jt.job_type_id
                WHERE 
                j.job_id = :id";
        $data = [':id' => $id];
        
        return $this->db->select($sql, $data);
    }
    
    public function applicantbyid($table_jobs, $id) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid ID");
        }
        $sql = "SELECT 
                a.application_id,
                u.full_name AS candidate_name,
                j.*,
                a.apply_at AS application_date,
                u.phone AS phone_number,
                u.email AS email_address,
                a.cv AS cv_file
            FROM 
                applications a
            JOIN 
                users u ON a.user_id = u.user_id
            JOIN 
                $table_jobs j ON a.job_id = j.job_id
            WHERE
                a.application_id = :id;
            ";
        $data = [':id' => $id];
    
        return $this->db->select($sql, $data);
    }
    
    public function insertjob($table_jobs, $data) {
        return $this->db->insert($table_jobs, $data);
    }

    public function updatejob($table_jobs, $data, $condition) {
        return $this->db->update($table_jobs, $data, $condition);
    }

    public function deletejob($table_jobs, $condition) {
        return $this->db->delete($table_jobs, $condition);
    }

}

