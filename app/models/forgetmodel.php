<?php
    class forgetmodel  extends DModel {
        public function __construct() {
            parent::__construct();
        }
        public function getUser(){
            $sql = "select * from users";
            return $this->db->select($sql);
        }
        public function updatePass($user_id, $newPass){
            $data=[];
            $data['password']=$newPass;
            $table="users";
            $condi="user_id=". $user_id;
            return $this->db->update($table,$data, $condi);
        }
    }

?>