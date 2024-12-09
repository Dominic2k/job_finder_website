<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

    body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f9f9f9;
    color: #333;
    }
    .covere{
        padding: 20px 2%;
    }
    .header {
    text-align: center;
    padding: 20px 10px;
    background-color: #fff;
    border-bottom: 1px solid #e0e0e0;
    }

    .header .highlight {
    color: #007bff;
    }

    .search-bar {
    display: flex;
    justify-content: center;
    margin-top: 10px;
    gap:30px
    }

    .search-input {
    width: 45%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    }
    .search-button {
    padding: 8px 12px;
    border: none;
    background-color: #007bff;
    color: #fff;
    border-radius: 4px;
    cursor: pointer;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    }
    .main-content {
    display: flex;
    padding: 20px 2%;
    gap: 20px;
    }
    .sidebar {
    flex: 1;
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px;
    }
    .sidebar-menu {
    list-style: none;
    }
    .sidebar-menu input[type="checkbox"] {
        display:none;
    }
    .sidebar-menu li {
    margin-bottom: 10px;
    border-radius:5px;
    }
    .label_filterSize:hover, .label_typeJob:hover, .label_levelJob:hover{
        color:white;
        background-color: #b8b8b8;
    }
    .sidebar-menu a {
    text-decoration: none;
    color: #007bff;
    }
    .sidebar-menu label {
    display:block;
    color: #007bff;
    border-radius:5px;
    }
    .job-list {
    flex: 3;
    }
    .job-listI {
    display:flex;
    flex-direction:row;
    flex-wrap:wrap;
    justify-content:space-between;
    }
    .job-listI  a {
        width:100%;
        text-decoration:none;
        color: black;
    }
    .job-list> h2 {
    margin-bottom: 20px;
    }
    .job-card {
    width:49%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px 20px;
    margin-bottom: 20px;
    margin-top:0
    }
    .cardJob-part1{
        display: flex;
        align-items: center;
        background-color: #fff;
    }
    .job-logo {
    width: 60px;
    height: 60px;
    }

    .job-info {
    flex: 1;
    margin-left: 20px;
    }

    .job-info h3 {
    font-size: 18px;
    margin-bottom: 5px;
    }

    .tags {
    display: flex;
    gap: 5px;
    margin-top: 5px;
    }

    .tag {
    display: inline-block;
    padding: 4px 8px;
    background-color: #e0e7ff;
    color: #4c51bf;
    border-radius: 12px;
    font-size: 12px;
    }
    .tag2 {
    display: inline-block;
    padding: 4px 8px;
    background-color: #E6F9F3;;
    color: #4BC4A3;
    border-radius: 12px;
    font-size: 12px;
    }
    .applyJob{
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
    }
    .applyJob button{
        background-color:blue;
        padding:10px 40px;
        border:0;
        color:white;
        border-radius:5px;  
    }
    .pagination{
        display:flex;
        justify-content: center;
        align-items:center;
    }
    .pagination > div{
        width: 60px;
        height:40px;
        border-top:1px solid black;
        border-bottom:1px solid black;
        border-left:1px solid black;
        box-sizing: border-box;
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .pagination > div:hover{
        background-color: #b8b8b8;
    }
    .act{
        background-color: #b8b8b8;
    }
    .b-right{
        border-right:1px solid black;
    }
    .fil_price{
        display:flex;
        margin-bottom:5px;
    }
    .fil_price b{
        width:15%;
        color:blue;
    }
    .fil_price input{
        flex:1;
        outline:none;
        border-radius:5px;
        border:none;
        border-bottom:1px solid gray;
    }
</style>
<?php
if(isset($data)&&$data){
    extract($data);
}
?>
<div class="covere">
<div class="header">
    <h1>Tìm kiếm <span class="highlight">công việc</span></h1>
    <p>Tìm sự nghiệp tiếp theo của bạn</p>
    <div class="search-bar">
        <input type="text" placeholder="Từ khóa" class="search-input" id="search-input">
        <button class="search-button" id="search-button">Tìm kiếm</button>
    </div>
</div>
</div>

<main class="main-content">
<aside class="sidebar">
    <b>Ngành</b>
    <ul class="sidebar-menu">
    <?php
    if(isset($industries)){
        foreach($industries as $indus){
            ?>
                 <li><label class="label_filterSize" for=""><input class="filter_indus" type="checkbox" data-ind="<?php echo($indus['industry_id']); ?>" value="<?php echo($indus['industry_id']); ?>"><?php echo($indus['industry_name']); ?></label></li>
            <?php
        }
    }
    ?>
    </ul>
    <b>Loại việc làm</b>
    <ul class="sidebar-menu">
    <?php
    if(isset($typeJobs)){
        foreach($typeJobs as $type){
            ?>
                 <li><label class="label_typeJob" for=""><input class="filter_type" type="checkbox" data-ind="<?php echo($type['job_type_id']); ?>" value="<?php echo($type['job_type_id']); ?>"><?php echo($type['job_type_name']); ?></label></li>
            <?php
        }
    }
    ?>
    </ul>
    <b>Cấp độ công việc</b>
    <ul class="sidebar-menu">
    <?php
    if(isset($levelJobs)){
        foreach($levelJobs as $level){
            ?>
                 <li><label class="label_levelJob" for=""><input class="filter_level" type="checkbox" data-ind="<?php echo($level['level_id']); ?>" value="<?php echo($level['level_id']); ?>"><?php echo($level['level_name']); ?></label></li>
            <?php
        }
    }
    ?>
    </ul>
    <b>Loại việc làm</b>
    <div >
        <div class="fil_price"><b>Từ:</b><input placeholder="Nhập số tiền tối thiểu" type="number" id="minPrice"></div>
        <div class="fil_price"><b>Đến:</b><input placeholder="Nhập số tiền tối đa" type="number" id="maxPrice"></div>
    </div>
    </aside>
    <section class="job-list">
    <h2 style="width:100%;">Kết quả tìm kiếm</h2>
    <div class="job-listI" id="job-listI">
        <!-- Danh sách cty đang có -->
    </div>
    <div class="pagination" id="pagination">
        <div ><<</div>
        <div >3</div>
        <div class="b-right">>></div>
    </div>
</section>
</main>
<script>
    var current_page=0;
    var numPage =0;
    var listCompanyCurrent=[];
    sessionStorage.removeItem('filter_jobs');
    //hàm lấy session với tham số truyền vào
    function getSessionStorage(who){
        const res = JSON.parse(sessionStorage.getItem(who));
        return res
    }
    //Tạo biến session mà chương trình sẽ làm việt với nó
    let object;
    if(!getSessionStorage('filter_jobs')){
        <?php if(!empty($array_filter) && $array_filter):?>
            <?php extract($array_filter);  ?>
        object=
        {
            a: <?php echo json_encode(!empty($industry) ? explode('a2x', $industry) : []); ?>,
            b: <?php echo json_encode(!empty($type) ? explode('a2x', $type) : []); ?>,
            c: <?php echo json_encode(!empty($level) ? explode('a2x', $level) : []); ?>,
            d: <?php echo json_encode(!empty($pr) ? explode('a2x', $pr) : []); ?>,
            e: <?php echo json_encode(!empty($search) ? $search : null); ?>
        }
        sessionStorage.setItem('filter_jobs', JSON.stringify(object));
        <?php else: ?>
            object={ a:[],b:[],c:[],d:[],e:null};
            sessionStorage.setItem('filter_jobs', JSON.stringify(object));
        <?php endif ;?>
    }
    console.log(getSessionStorage('filter_jobs'));//Hiện object
    var filter_indus=document.querySelectorAll('.filter_indus');
    // Lệnh bật trạng thái đã nhấn của của option INDUSTRY;
    if(getSessionStorage('filter_jobs') && getSessionStorage('filter_jobs').a.length >0){
        filter_indus.forEach(tag_indus =>{
            let check = getSessionStorage('filter_jobs').a.some(num => parseInt(num) == parseInt(tag_indus.dataset.ind));
            if(check){
                tag_indus.checked = true;
            }
        })
    }
    var filter_ty=document.querySelectorAll('.filter_type');
    // Lệnh bật trạng thái đã nhấn của của option type_jobs;
    if(getSessionStorage('filter_jobs') && getSessionStorage('filter_jobs').b.length >0){
        filter_ty.forEach(tag_indus =>{
            let check = getSessionStorage('filter_jobs').b.some(num => parseInt(num) == parseInt(tag_indus.dataset.ind));
            if(check){
                tag_indus.checked = true;
            }
        })
    }
    var filter_levelal=document.querySelectorAll('.filter_level');
    // Lệnh bật trạng thái đã nhấn của của option level_jobs;
    if(getSessionStorage('filter_jobs') && getSessionStorage('filter_jobs').c.length >0){
        filter_levelal.forEach(tag_indus =>{
            let check = getSessionStorage('filter_jobs').c.some(num => parseInt(num) == parseInt(tag_indus.dataset.ind));
            if(check){
                tag_indus.checked = true;
            }
        })
    }
    var filter_pr=document.querySelectorAll('.fil_price');
    // Lệnh bật trạng thái đã nhấn của của option level_jobs;
    if(getSessionStorage('filter_jobs') && getSessionStorage('filter_jobs').d.length >0){
        let nn=0;
        filter_pr.forEach(tag_indus =>{
            tag_indus.querySelector('input').value=getSessionStorage('filter_jobs').d[nn];
            nn++;
        })
    }
    //Hàm hiện màu cho các option của Industries,type,level
    displayColorFilterInd('.label_filterSize');
    displayColorFilterInd('.label_typeJob');
    displayColorFilterInd('.label_levelJob');
    function displayColorFilterInd(nameClassLable){
        let lable_filterSize=document.querySelectorAll(nameClassLable);
        lable_filterSize.forEach(lab => {
            let inp = lab.querySelector('input');
            if(inp.checked==true){
                lab.style.backgroundColor  ="#b8b8b8";
                lab.style.color="white";
            }else{
                lab.style.backgroundColor  ="inherit";
                lab.style.color="blue";
            }
        })
    }console.log();
    //Sử dụng phương thức AJAX để gửi yêu câù tới máy chủ và nhận dữ liệu trả về để hiện lên các thẻ job
    callSever();
    //Lọc theo ngành
    var filter_indusL=document.querySelectorAll('.label_filterSize');
    filter_indusL.forEach(tag_indus =>{
        tag_indus.addEventListener('click', function(){
            let inp = tag_indus.querySelector('input');
            if(inp.checked==true){
                inp.checked=false;
            }else{
                inp.checked=true;
            }
            let object=getSessionStorage('filter_jobs');
            if(inp.checked == true){
                object.a.push(parseInt(inp.dataset.ind));
            }else{
                object.a = object.a.filter(num => Number(num) !== Number(inp.dataset.ind));
            } 
            sessionStorage.setItem('filter_jobs', JSON.stringify(object));
            console.log(getSessionStorage('filter_jobs'));
            displayColorFilterInd('.label_filterSize');
            displayColorFilterInd('.label_typeJob');
            displayColorFilterInd('.label_levelJob');
            callSever();
        })
    })
    //Lọc theo type of job
    var filter_typel=document.querySelectorAll('.label_typeJob');
    filter_typel.forEach(tag_indus =>{
        tag_indus.addEventListener('click', function(){
            let inp = tag_indus.querySelector('input');
            if(inp.checked==true){
                inp.checked=false;
            }else{
                inp.checked=true;
            }
            let object=getSessionStorage('filter_jobs');
            if(inp.checked == true){
                object.b.push(parseInt(inp.dataset.ind));
            }else{
                object.b = object.b.filter(num => Number(num) !== Number(inp.dataset.ind));
            } 
            sessionStorage.setItem('filter_jobs', JSON.stringify(object));
            console.log(getSessionStorage('filter_jobs'));
            displayColorFilterInd('.label_filterSize');
            displayColorFilterInd('.label_typeJob');
            displayColorFilterInd('.label_levelJob');
            callSever();
        })
    })
    //Lọc theo level for job
    var filter_levela=document.querySelectorAll('.label_levelJob');
    filter_levela.forEach(tag_indus =>{
        tag_indus.addEventListener('click', function(){
            let inp = tag_indus.querySelector('input');
            if(inp.checked==true){
                inp.checked=false;
            }else{
                inp.checked=true;
            }
            let object=getSessionStorage('filter_jobs');
            if(inp.checked == true){
                object.c.push(parseInt(inp.dataset.ind));
            }else{
                object.c = object.c.filter(num => Number(num) !== Number(inp.dataset.ind));
            } 
            sessionStorage.setItem('filter_jobs', JSON.stringify(object));
            console.log(getSessionStorage('filter_jobs'));
            displayColorFilterInd('.label_filterSize');
            displayColorFilterInd('.label_typeJob');
            displayColorFilterInd('.label_levelJob');
            callSever();
        })
    })
    //Chức năng cho pháp người dùng tìm kiếm theo tên công ty
    var searchS=document.getElementById('search-button');
    var inputS =document.getElementById('search-input');
    searchS.addEventListener('click',function(){
        let object=getSessionStorage('filter_jobs');
        object.e=inputS.value;
        sessionStorage.setItem('filter_jobs', JSON.stringify(object));
        callSever();
        console.log(getSessionStorage('filter_jobs'));
    })
    //Chức năng cho phép người dùng nhập số tiền tối thiểu và tối đa để tìm việc cới mức lương phù hợp
    var fil_minPrice=document.getElementById('minPrice');
    var fil_maxPrice=document.getElementById('maxPrice');
    fil_minPrice.addEventListener('input',function(){
        let object=getSessionStorage('filter_jobs');
        object.d[0]=fil_minPrice.value;
        sessionStorage.setItem('filter_jobs', JSON.stringify(object));
        callSever();
        console.log(getSessionStorage('filter_jobs'));
    })
    fil_maxPrice.addEventListener('input',function(){
        let object=getSessionStorage('filter_jobs');
        object.d[1]=fil_maxPrice.value;
        sessionStorage.setItem('filter_jobs', JSON.stringify(object));
        callSever();
        console.log(getSessionStorage('filter_jobs'));
    })
    //Hàm sử dụng ajax
    function callSever(){
        fetch('http://localhost/job_finder_website/public/ajax/refreshJobs.php/', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(getSessionStorage('filter_jobs'))
        })
        .then(response => response.text())
        .then(data => {
            try {
                console.log(data);
                let jsonData = JSON.parse(data);
                listCompanyCurrent=jsonData;
                current_page=1;
                if(jsonData.length%14 ==0){
                    numPage=Math.floor(jsonData.length/14);
                }else{
                    numPage=Math.floor(jsonData.length/14)+1;
                }
                let ttt=findPsFlPage(jsonData);
                displayCompanies(ttt);
                displayPagination();
            } catch (error) {
                console.error('Error parsing JSON:', error);
            }
        })
        .catch(error => console.error('Fetch error:', error));
    }
    //Hàm hiển trang hiển thị card job
    function displayCompanies(job){
        var liJob=job;
        var boxListC=document.getElementById('job-listI');
        boxListC.innerHTML ="";
        if(liJob.length>0){
            liJob.forEach( job =>{
                var liIndustries=<?php echo json_encode($industries); ?>;
                var liLevel=<?php echo json_encode($levelJobs); ?>;
                var liCompanies=<?php echo json_encode($companies); ?>;
                let comA=[];
                let indusA=[];
                let levelA=[];
                for(let com of liCompanies){
                    if(com.user_id==job.user_id){
                        comA = com;
                        for(let ind of liIndustries){
                            if(ind.industry_id==com.industry_id){
                                indusA=ind;
                                break;
                            }
                        }
                        break;
                    }
                }
                for(let lev of liLevel){
                    if(lev.level_id=job.level_id){
                        levelA=lev;
                        break;
                    }
                }
                boxListC.innerHTML +=
                `
                <div class="job-card">
                    <div class="cardJob-part1">
                        <img src="stripe-logo.png" alt="Stripe" class="company-logo">
                        <div class="company-info">
                            <div>
                                <h3>${job.job_title}</h3>
                            </div>
                            <p >${comA.comp_name}</p>
                            <div class="tags">
                                <span class="tag">${indusA.industry_name}</span>
                                <span>&nbsp&nbsp</span>
                                <span class="tag2">${levelA.level_name}</span>
                            </div>
                        </div> 
                    </div><!--Part1-->
                    <div class="applyJob">
                        <button>nộp</button>
                        <p>${job.job_total_applied}|${job.job_required_candidates}</p>
                    </div>
                </div>
                `
            })
        }
    }
    //Hàm hiện trang điều hướng
    function displayPagination(){
        var sesPage=document.getElementById('pagination');
        sesPage.innerHTML="";
        if(numPage>1){
            let numPagePres=1;
            let numPageNext=1;
            if(current_page==1){
                numPagePres=1;
                numPageNext=current_page+1;
            }else if(current_page==numPage){
                 numPageNext=numPage;
                 numPagePres=current_page-1;
            }else{
                numPagePres=current_page-1;
                numPageNext=current_page+1;
            }
            let nodeStart=document.createElement('div');
            nodeStart.dataset.page=1;
            nodeStart.style.width="100px";
            nodeStart.textContent="Trang đầu";
            sesPage.appendChild(nodeStart);
            let nodePres=document.createElement('div');
            nodePres.dataset.page=numPagePres;
            nodePres.textContent="<<";
            sesPage.appendChild(nodePres);
            if(numPage<=5){
                for(let i=1; i<=numPage;i++){
                    let node=document.createElement('div');
                    if(i==current_page){
                        node.className="act";
                    }
                    node.dataset.page=i;
                    node.textContent=`${i}`;
                    sesPage.appendChild(node);
                }
            }else{
                if((current_page-2)<1){
                    for(let i=1;i<=current_page;i++){
                        let node=document.createElement('div');
                        if(i==current_page){
                            node.className="act";
                        }
                        node.dataset.page=i;
                        node.textContent=`${i}`;
                        sesPage.appendChild(node);
                    }
                    for(let i=(current_page+1);i<=5;i++){
                        let node=document.createElement('div');
                        if(i==current_page){
                            node.className="act";
                        }
                        node.dataset.page=i;
                        node.textContent=`${i}`;
                        sesPage.appendChild(node);
                    }
                }else if(((current_page+2)-numPage)>0){
                    let numPagePr=5-(1+(numPage-current_page));
                    for(let i=(current_page-numPagePr);i<current_page;i++){
                        let node=document.createElement('div');
                        if(i==current_page){
                            node.className="act";
                        }
                        node.dataset.page=i;
                        node.textContent=`${i}`;
                        sesPage.appendChild(node);
                    }
                    for(let i=current_page;i<=numPage;i++){
                        let node=document.createElement('div');
                        if(i==current_page){
                            node.className="act";
                        }
                        node.dataset.page=i;
                        node.textContent=`${i}`;
                        sesPage.appendChild(node);
                    }
                }else{
                    for(let i=(current_page-2);i<=current_page+2;i++){
                        let node=document.createElement('div');
                        if(i==current_page){
                            node.className="act";
                        }
                        node.dataset.page=i;
                        node.textContent=`${i}`;
                        sesPage.appendChild(node);
                    }
                }
            }
            let nodeNext=document.createElement('div');
            nodeNext.dataset.page=numPageNext;
            nodeNext.className="b-right"
            nodeNext.textContent=">>";
            sesPage.appendChild(nodeNext);
        }
        //Sự kiện khi nhấn vào phân trang
        var boxPagination =document.getElementById('pagination');
        var butPaginations=boxPagination.querySelectorAll('div');
        butPaginations.forEach(buttonPage=>{
            console.log("ss");
            buttonPage.addEventListener('click',function(){
                console.log(current_page);
                console.log(buttonPage.dataset.page);
                current_page=parseInt(buttonPage.dataset.page);
                let ttt=findPsFlPage(listCompanyCurrent);
                displayCompanies(ttt);
                displayPagination();
            })
        })
    }
    //Hàm trả ra danh sách các phần tư theo trang
    function findPsFlPage(list){
    let start=(current_page-1)*14// 2 ở đây số phần tủ sẽ lấy trong một trang, ví dụ một trang có 10 thì là 10
    let end=start+14;//tương tự
    let resLi=list.slice(start,end);
    return resLi;
    }
</script>
</body>
</html>