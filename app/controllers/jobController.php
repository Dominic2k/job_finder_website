<?php

class jobController extends DController{
        public function __construct() {
        $data = array();
        $message = array();
        
        parent::__construct();
    }

    public function updateStatusJob() {
        session_start();
        $job = $this->load->model('jobmodel');

        $job_id = $_GET['id'];
        $status = $_GET['status'];

        var_dump($job_id);
        var_dump($status);

        $table_jobs = 'jobs';

        $condition = "$table_jobs.job_id = '$job_id'";
        if ($status == 'open') {
            $data = array(
                'job_status' => 'close'
            );
        }else {
            $data = array(
                'job_status' => 'open'
            );
        }

        var_dump($data);
        var_dump($condition);

        $msgUpdateStatusJob = $job->updateStatusJob($table_jobs, $data, $condition);

        if ($msgUpdateStatusJob == 1) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Đã cập nhật trạng thái công việc!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Cập nhật trạng thái công việc thất bại!'
            ];
        }        
        header("Location: http://localhost/job_finder_website/recruiter/recruiter");
        exit();

    }

}