<?php
header('Content-Type: application/json');
include '../../system/library/Database.php';
include '../../system/library/DModel.php';
include '../../app/models/searchjobmodel.php';
$model= new searchjobmodel();
$object_filter = json_decode(file_get_contents('php://input'));
$listIndS="";
$listTy="";
$listLe="";
$listPr="";
$strFilter="";
$dataS=[];
if(count($object_filter->a)>0){
    foreach($object_filter->a as $key => $value){
        $listIndS .= $value;
        if($key<(count($object_filter->a)-1)){
            $listIndS .= "a2x";
        }
    }
    $dataS['industry']=$listIndS;
}else{
    $dataS['industry']=$listIndS;
}
if(count($object_filter->b)>0){
    foreach($object_filter->b as $key => $value){
        $listTy .= $value;
        if($key<(count($object_filter->b)-1)){
            $listTy .= "a2x";
        }
    }
    $dataS['type']=$listTy;
}else{
    $dataS['type']=$listTy;
}
//kết quả của level
if(count($object_filter->c)>0){
    foreach($object_filter->c as $key => $value){
        $listLe .= $value;
        if($key<(count($object_filter->c)-1)){
            $listLe .= "a2x";
        }
    }
    $dataS['level']=$listLe;
}else{
    $dataS['level']=$listLe;
}
//kết quả của pr
if(count($object_filter->d)>0){
    foreach($object_filter->d as $key => $value){
        $listPr .= $value;
        if($key<(count($object_filter->d)-1)){
            $listPr.= "a2x";
        }
    }
    $dataS['pr']=$listPr;
}else{
    $dataS['pr']=$listPr;
}
$dataS['search'] = isset($object_filter->e) ? $object_filter->e : '';
foreach($dataS as $key => $value){
    if(!empty($value)){
        $strFilter .= $key."=".$value;
    }else{
        $strFilter .= $key."=";
    }
    if($key!='search'){
        $strFilter .=",";
    }
}
//gọi pt tìm cong việc
$res_com=$model->getJobs($dataS);
if(!empty($res_com)){
    echo json_encode($res_com);
}else{
    echo json_encode([]);
}
exit; 