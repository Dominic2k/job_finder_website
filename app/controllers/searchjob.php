<?php
class searchjob extends DController{
    public function __construct(){
        $data=array();
        parent::__construct();
    }
    public function searchjob($parameter = false){
        $model=$this->load->model('searchjobmodel');
        $data['industries']=$model->getIndustries();
        $data['typeJobs']=$model->getJob_Type();
        $data['levelJobs']=$model->getLevels();
        $data['companies']=$model->getCompanies();
        $data['users']=$model->getUsers();
        //['industry'=>[1,2,3],'size'=>'1']
        if($parameter){
            $array = explode(",", $parameter);
            $re_array=[];
            foreach($array as $ar){
                $t=explode("=", $ar);
                $re_array[$t[0]]=(count($t)>1)?$t[1]:"";
            }
            $data['array_filter']=$re_array;
            //print_r($list);
            $data['jobs']=$model->getJobs($re_array);
           // print_r($data['companies']);
            $this->load->view('searchjob',$data);
        }else{
            $data['jobs']=$model->getJobs();
            $this->load->view('searchjob',$data);
        }
    }
}
?>