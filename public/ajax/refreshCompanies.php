<?php
header('Content-Type: application/json');
include '../../system/library/Database.php';
include '../../system/library/DModel.php';
include '../../app/models/searchcompanymodel.php';
$model= new searchcompanymodel();
$object_filter = json_decode(file_get_contents('php://input'));
$listIndS="";
$strFilter="";
$dataS=[];
if(count($object_filter->a)>0){
    foreach($object_filter->a as $key => $value){
        $listIndS .= $value;
        if($key<(count($object_filter->a)-1)){
            $listIndS .= "%";
        }
    }
    $dataS['industry']=$listIndS;
}else{
    $dataS['industry']=$listIndS;
}
$dataS['size'] = isset($object_filter->b) ? $object_filter->b : '';
$dataS['search'] = isset($object_filter->c) ? $object_filter->c : '';
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
$res_com=$model->getCompanies($dataS);
if(!empty($res_com)){
    echo json_encode($res_com);
}else{
    echo json_encode([]);
}
exit; 