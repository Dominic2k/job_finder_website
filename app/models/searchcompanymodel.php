<?php
    class searchcompanymodel  extends DModel {
        public function __construct() {
            parent::__construct();
        }
        public function getIndustries(){
            $sql = "select * from industries";
            return $this->db->select($sql);
        }
        public function getJobs(){
            $sql = "select * from jobs ";;
            return $this->db->select($sql);
        }
        public function getJob_Type(){
            $sql = "select * from job_types";
            return $this->db->select($sql);
        }
        public function getCompanies($parameter =false){
            if (!empty($parameter)) {
                extract($parameter);
                $condi = "";
                $data = [];
                if(!empty($industry)){$industry=explode('%',$industry);}
                if (!empty($industry) && is_array($industry)) {
                    $n = 1;
                    foreach ($industry as $value) {
                        $or = ($n < count($industry)) ? " OR " : ((!empty($size) || !empty($search)) ? " AND " : " ");
                        $key = ":industry_id" . $n;
                        $condi .= "industry_id = $key" . $or;
                        $data[$key] = intval($value);
                        $n++;
                    }
                }
                if (!empty($size)) {
                    if ($size == "1") {
                        $key = ":employee_count";
                        $condi .= "employee_count <= $key ";
                        $data[$key] = 50;
                    } else {
                        $key1 = ":min";
                        $key2 = ":max";
            
                        switch ($size) {
                            case "2":
                                $data[$key1] = 50;
                                $data[$key2] = 100;
                                break;
                            case "3":
                                $data[$key1] = 100;
                                $data[$key2] = 200;
                                break;
                            case "4":
                                $data[$key1] = 200;
                                $data[$key2] = 500;
                                break;
                            case "5":
                                $data[$key1] = 500;
                                $data[$key2] = 1000;
                                break;
                        }
            
                        $condi .="employee_count BETWEEN $key1 AND $key2 ";
                    }
                    $condi .=(!empty($search)) ? " and " :"";
                }
                if(!empty($search)){
                    $key=":comp_name";
                    $condi.="comp_name like ".$key;
                    $data[$key]= "%".$search."%";
                }
                $sql = !empty($condi) 
                    ? "SELECT * FROM companies WHERE " . trim($condi) 
                    : "SELECT * FROM companies";
            
                return $this->db->select($sql,$data);
            }else{
                $sql = "select * from companies";
                return $this->db->select($sql);
            }
        }
    }

?>