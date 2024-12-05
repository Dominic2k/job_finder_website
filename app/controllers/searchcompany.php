<?php
class searchcompany extends DController{
    public function __construct(){
        $data=array();
        parent::__construct();
    }
    public function searchcompany($parameter = false){
        $model=$this->load->model('searchcompanymodel');
        $data['industries']=$model->getIndustries();
        $data['job_type']=$model->getJob_Type();
        $data['jobs']=$model->getJobs();
        //['industry'=>[1,2,3],'size'=>'1']
        $data['model']=$model;
        if($parameter){
            $array = explode(",", $parameter);
            $re_array=[];
            foreach($array as $ar){
                $t=explode("=", $ar);
                $re_array[$t[0]]=(count($t)>1)?$t[1]:"";
            }
            $data['array_filter']=$re_array;
            //print_r($list);
            $data['companies']=$model->getCompanies($re_array);
           // print_r($data['companies']);
            $this->load->view('searchcompany',$data);
        }else{
            $data['companies']=$model->getCompanies();
            $this->load->view('searchcompany',$data);
        }
    }
}
?>