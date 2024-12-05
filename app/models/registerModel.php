<?php
    class registerModel  extends DModel {
        public function __construct() {
            parent::__construct();
        }
        public function getUser(){
            $sql = "select * from users";
            return $this->db->select($sql);
        }
        public function getCompany(){
            $sql = "select * from companies";
            return $this->db->select($sql);
        }
        public function getIndustry(){
            $sql = "select * from industries";
            return $this->db->select($sql);
        }
        public function addUser($name,$phone,$email,$password,$role){
            //job table và data['key'=>$value];
            $rpassword=md5($password);
            $data=['full_name'=>$name,'phone'=>$phone,'email'=>$email,'password'=>$rpassword,'role'=>$role];
            return $this->db->insert("users", $data);
        }
        public function addCompany($nameCompany,$industry,$address,$id_user){
            $data=['comp_name'=>$nameCompany,'industry_id'=>$industry,'comp_address'=>$address,'user_id'=>$id_user];
            return $this->db->insert("companies", $data);
        }
    }

?>