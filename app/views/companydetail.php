<style>
    *{
        box-sizing:border-box;
    }
    html,body{
        padding:0;
        margin:0;
        font-family: Arial, sans-serif;
        line-height: 1.6;
        background-color: #f9f9f9;
        color: #333;
    }
    .cf{
        width: 100%;
        padding-left:2%;
        padding-top:10px;
        padding-bottom:10px;
        padding-right:2%;
    }
    .banner-company{
        display:flex;
        margin:20px 0;
    }
    .logo-company{
        width: 120px;
        height:120px;
        border:1px solid black;
    }
    .banber-info{
        flex:1;
        padding-left:20px;
        display:flex;
        flex-direction:column;
        justify-content:space-between;
    }
    .b-row{
        display:flex;
        align-items:center;
    }
    .numJob{
        padding:5px 10px;
        display:flex;
        justify-content:center;
        align-items:center;
        border:1px solid blue;
        margin: 0 10px;
        color:blue;
    }
    .itemC{
        padding:5px 10px;
        display:flex;
        justify-content:center;
        align-items:center;
        margin-right: 10px;
        margin-bottom:5px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    }
    .icon-info{
        width:20px;
        height:20px;
        border-radius:50%;
        background:white;
        margin-right:10px;
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .icon-info i{
        color:blue;
    }
    .b-flex-column{
        display:flex;
        flex-direction:column;
    }
    .com2{
        display:flex;
    }
    .com2-left{
        width: 70%;
    }
    .com2-right{
        flex:1;
        padding:0 10px;
    }
    .box-image{
        width: 150px;
        height:100px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    }
    .flex-wrap{
        flex-wrap:wrap;
    }
    .card_benefic{
        width: 240px;
        margin-right:10px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    }
    .card_benefic h3{
        margin-top:0;
    }
    .card_job{
        width: 49%;
        background:white;
        padding-left:4%;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    }
    .card__logo {
        width: 60px;
        height: 60px;
        object-fit: contain;
        margin-right: 16px;
    }
    .card__content {
        flex: 1;
    }
    .card__tags {
        display: flex;
        gap: 8px;
        margin-top: 8px;
    }
    .tag {
        display: inline-block;
        font-size: 12px;
        font-weight: 500;
        padding: 4px 8px;
        border-radius: 16px;
        text-align: center;
        display: inline-block;
        background-color: #e0e7ff;
        color: #4c51bf;
    }
    .mar{
        margin:0;
    }
    .control-displayJob{
        display:flex;
        justify-content:center;
        align-items:center;
        padding:2px 20px;
    }
    .control-displayJob:hover{
        background:#b8b8b8;
        cursor:pointer;
    }
</style>
<?php
if(isset($data)&&$data){
    extract($data);
}
//print_r($data);
if(isset($job)){
}
if(isset($company)){
}
$numJob= count($job);
?>
<div class="cf" style="background:rgb(248,248,253);">
    <div class="banner-company">
        <div class="logo-company">
            <img src="" alt="Logo">
        </div>
        <div class="banber-info">
            <div class="b-row">
                <h1 style="margin:0;padding:0;"><?php if(isset($company)){echo($company[0]['comp_name']);} ?></h1>
                <div class="numJob"><?php if(isset($job)){echo(count($job));}?> công việc</div>
            </div>
            <div class="b-row">
                <a href="<?php if(isset($company)){echo($company[0]['comp_website']);} ?>"> <?php if(isset($company)){echo($company[0]['comp_website']);} ?></a>
            </div>
            <div class="b-row" style="gap:0 30px;">
                <div  class="b-row">
                    <div class="icon-info"><i class="fas fa-fire"></i></div>
                    <div class="b-flex-column">
                        <div>Ngày thành lập</div>
                        <div><b><?php echo isset($company[0]['founded_date']) ? htmlspecialchars($company[0]['founded_date']) : "N/A"; ?></b></div>
                    </div>
                </div>
                <div  class="b-row">
                    <div class="icon-info"><i class="fas fa-users"></i></div>
                    <div class="b-flex-column">
                        <div>Nhân viên</div>
                        <div>
                            <b>
                                <?php echo($company[0]['employee_count']);?>
                            </b>
                        </div>
                    </div>
                </div>
                <div class="b-row">
                    <div class="icon-info"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="b-flex-column">
                        <div>Trụ sở</div>
                        <div><b><?php if(isset($company)){echo($company[0]['comp_address']);} ?></b></div>
                    </div>
                </div>
                <div class="b-row">
                    <div class="icon-info"><i class="fas fa-building"></i></div>
                    <div class="b-flex-column">
                        <div>Ngành</div>
                        <div>
                            <b>
                                <?php 
                                    if(isset($industry)&&isset($company)){
                                        foreach($industry as $value){
                                            if($value['industry_id']==$company[0]['industry_id']){
                                                echo($value['industry_name']);
                                            }
                                        }
                                    } 
                                ?>
                            </b>
                        </div>
                    </div>
                </div>
            </div><!-- -->
        </div><!--banner-info -->
    </div><!--banner -->
</div><!-- com-->
<br>
<div class="cf" >
    <div class="com2" style=" box-shadow: 0 2px 3px -3px rgba(0, 0, 0, 0.5);">
        <div class="com2-left" >
            <h2>Hồ sơ công ty</h2>
            <div>
                    <?php if(isset($company)){echo($company[0]['comp_description']);} ?>
            </div>
            <h2>Quyền lợi và lợi ích</h2>
            <div class="b-row flex-wrap" >
                    <?php 
                        if(isset($company)){
                            echo($company[0]['comp_benefit']);
                        } 
                    ?>
            </div>
        </div>
        <div class="com2-right">
            <h2 style="margin-bottom:10px;padding:0;">Trụ sở công ty</h2>
            <!--<p class="mar" style="margin-bottom:10px">công tay có x trụ sở</p>-->
            <div class="b-flex-column"  style="gap:20px 0;padding-bottom:10px;">
                <p class="mar"><b><?php if(isset($company)){echo($company[0]['comp_address']);} ?></b></p>
            </div>
        </div><!--com2-right-->
    </div><!--com2-->
</div>
<div class="cf" style="background:rgb(248,248,253);">
    <div class="b-row" style="justify-content:space-between;">
        <h2>Việt làm mở</h2>
        <div class="control-displayJob" data-ctrlD="1">></div>
    </div>
    <div class="b-row flex-wrap" style="gap: 10px 20px;justify-content: space-between;">
        <?php
            if(isset($job)){
                //lấy các công việt có deadline chưa đến hạng
                $dateCurent= new dateTime();
                $list2=[];
                foreach($job as $value){
                    $dedJob=new dateTime($value['job_deadline']);
                    if($dedJob>$dateCurent){
                        array_push($list2, $value);
                    }
                }
                $job=$list2;
                foreach($job as $index => $value){
                    $ind = null;
                    foreach($industry as $valuechil){
                        if($company[0]['industry_id']==$valuechil['industry_id']){
                            $ind=$valuechil;
                            break;
                        }else{
                            $ind=[];
                        }
                    }
                    $ty = null;
                    foreach($job_type as $type ){
                        if($type['job_type_id']==$value['job_type_id']){
                            $ty=$type;
                            break;
                        }else{
                            $ty=[];
                        }
                    }
                    ?>
                        <div class="b-row card_job" data-display="<?php if($index>3){ echo(2);}else{echo(1);}?>">
                            <div class="card__logo">
                                <img src="logo-placeholder.png" alt="Company Logo">
                            </div>
                            <div class="card__content">
                                <h3 ><?php echo htmlspecialchars($value['job_title']); ?></h3>
                                <p ><?php echo htmlspecialchars($value['job_location']); ?></p>
                                <div class="card__tags">
                                <span class="tag "><?php echo isset($ty) ? htmlspecialchars($ty['job_type_name']) : 'N/A'; ?></span>
                                <span class="tag "><?php echo isset($ind) ? htmlspecialchars($ind['industry_name']) : 'N/A';?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            } 
        ?>
    </div>
</div>
<script>
    //document.addEventListener('DOMContentLoaded',showResultRooms);
    var card_jobs= document.querySelectorAll('.card_job');
    card_jobs.forEach(job => {
        if(job.dataset.display==1){
            job.style.display="flex";
        }else{
            job.style.display="none";
        }
    } )
    var ctrlDisplay=document.querySelector('.control-displayJob');
    ctrlDisplay.addEventListener('click',function(){
        if(ctrlDisplay.dataset.ctrlD==1){
            ctrlDisplay.dataset.ctrlD=0;
            ctrlDisplay.innerHTML="<";
            card_jobs.forEach(job=>{
                job.style.display="flex";
            })
        }else{
            ctrlDisplay.dataset.ctrlD=1;
            ctrlDisplay.innerHTML=">";
            card_jobs.forEach(job=>{
                if(job.dataset.display==1){
                    job.style.display="flex";
                }else{
                    job.style.display="none";
                }
            })
        }
    })
</script>