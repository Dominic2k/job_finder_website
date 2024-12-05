<?php
    class companydetailmodule  extends DModel {
        public function __construct() {
            parent::__construct();
        }
        public function getCompany($company_name){
            $sql = "select * from companies where comp_name = :company_name";
            $data=[':company_name'=> $company_name];
            return $this->db->select($sql,$data);
        }
        public function getJob($user_id){
            $sql = "select * from jobs where user_id = :user_id and job_status='open'";;
            $data=[':user_id'=>$user_id];
            return $this->db->select($sql,$data);
        }
        public function getIndustry(){
            $sql = "select * from industries";
            return $this->db->select($sql);
        }
        public function getJob_Type(){
            $sql = "select * from job_types";
            return $this->db->select($sql);
        }
    }

?>