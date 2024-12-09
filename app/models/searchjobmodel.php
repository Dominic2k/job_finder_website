<?php
    class searchjobmodel  extends DModel {
        public function __construct() {
            parent::__construct();
        }
        public function getUsers(){
            $sql = "select * from users";
            return $this->db->select($sql);
        }
        public function getCompanies(){
            $sql = "select * from companies";
            return $this->db->select($sql);
        }
        public function getIndustries(){
            $sql = "select * from industries";
            return $this->db->select($sql);
        }
        public function getJob_type(){
            $sql = "select * from job_types";
            return $this->db->select($sql);
        }
        public function getLevels(){
            $sql = "select * from levels";
            return $this->db->select($sql);
        }
        public function getCompanyFromIndustry($list){
            $data=[];
            $condi="";
            $n = 1;
            foreach ($list as $value) {
                $or = ($n < count($list)) ? " OR " : " ";
                $key = ":industry_id" . $n;
                $condi .= "industry_id = $key" . $or;
                $data[$key] = intval($value);
                $n++;
            }
            $sql = !empty($condi) 
            ? "SELECT * FROM companies WHERE " . trim($condi) 
            : "SELECT * FROM companies where industry_id = 0";
    
            return $this->db->select($sql,$data);
        }
        public function getJobFromCom($com){
            $data=[];
            $condi="";
            $n = 1;
            foreach($com as $company){
                $or = ($n < count($com)) ? " OR " : " ";
                $key = ":user_id" . $n;
                $condi .= "user_id = $key" . $or;
                $data[$key] = intval($company['user_id']);
                $n++;
            }
            $sql = !empty($condi) 
            ? "SELECT * FROM jobs WHERE " . trim($condi) 
            : "SELECT * FROM jobs where user_id = 0";
    
            return $this->db->select($sql,$data);
        }
        public function getjobs($parameter = []){

            if (!empty($parameter)) {
                extract($parameter);
                $condi = "";
                $data = [];
                if(!empty($industry)){$industry=explode('a2x',$industry);}
                if (!empty($industry) && is_array($industry)) {
                    $listJ=$this->getJobFromCom($this->getCompanyFromIndustry($industry));
                    if(count($listJ)>0){
                        $n = 1;
                        foreach ($listJ as $value) {
                            $or = ($n < count($listJ)) ? " OR " : ((!empty($type) || !empty($level) || !empty($pr)  || !empty($search)) ? " AND " : " ");
                            $key = ":job_id" . $n;
                            $condi .= "job_id = $key" . $or;
                            $data[$key] = intval($value['job_id']);
                            $n++;
                        }
                    }else{
                        $key = ":job_id";
                        $condi .= "job_id = $key";
                        $data[$key] = intval(0);
                    }
                }
                if(!empty($type)){$type=explode('a2x',$type);}
                if (!empty($type) && is_array($type)) {
                    $n = 1;
                    foreach ($type as $value) {
                        $or = ($n < count($type)) ? " OR " : ((!empty($level) || !empty($pr) || !empty($search)) ? " AND " : " ");
                        $key = ":job_type_id" . $n;
                        $condi .= "job_type_id = $key" . $or;
                        $data[$key] = intval($value);
                        $n++;
                    }
                }
                if(!empty($level)){$level=explode('a2x',$level);}
                if (!empty($level) && is_array($level)) {
                    $n = 1;
                    foreach ($level as $value) {
                        $or = ($n < count($level)) ? " OR " : (( !empty($pr) || !empty($search)) ? " AND " : " ");
                        $key = ":level_id" . $n;
                        $condi .= "level_id = $key" . $or;
                        $ko=$value;
                        $data[$key] = intval($value);
                        $n++;
                    }
                }
                if(!empty($pr)){$pr=explode('a2x',$pr);}
                if (!empty($pr) && is_array($pr)) {
                    $or =  !empty($search)? " AND " : " ";
                    if(!empty($pr[0]) && empty($pr[1])){
                        $key=":salary";
                        $data[$key] = intval($pr[0]);
                        $condi .="job_salary > $key ".$or;
                    }else if(empty($pr[0]) && !empty($pr[1])){
                        $key=":salary";
                        $data[$key] = intval($pr[1]);
                        $condi .="job_salary < $key ".$or;
                    } else if(!empty($pr[0]) && !empty($pr[1])){
                        $key1 = ":salary1";
                        $key2 = ":salary2";
                        $condi .="job_salary BETWEEN $key1 AND $key2 ".$or;
                        $data[$key1] = intval($pr[0]);
                        $data[$key2] = intval($pr[1]);
                    }
                }
                if(!empty($search)){
                    $key=":job_title";
                    $condi.="job_title like ".$key;
                    $data[$key]= "%".$search."%";
                }
                $sql = !empty($condi) 
                    ? "SELECT * FROM jobs WHERE " . trim($condi) 
                    : "SELECT * FROM jobs";
                return $this->db->select($sql,$data);
            }else{
                $sql = "select * from jobs";
                return $this->db->select($sql);
            }
        }
    }

?>