<?php session_start();?>
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
        padding-top:70px;
    }
    .head-resCom {
    text-align: center;
    padding: 20px 10px;
    background-color: #fff;
    border-bottom: 1px solid #e0e0e0;
    }

    .head-resCom .highlight {
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
    .label_filterSize:hover {
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
    .company-list {
    flex: 3;
    }
    .company-listI {
    display:flex;
    flex-direction:row;
    justify-content: space-between;
    flex-wrap:wrap;
    }
    .company-listI > a {
        width:48%;
        text-decoration:none;
        color: black;
    }
    .company-list h2 {
    margin-bottom: 20px;
    }
    .company-card {
    width:100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 20px;
    margin-top:0
    }

    .company-logo {
    width: 50px;
    height: 50px;
    }

    .company-info {
    flex: 1;
    margin-left: 20px;
    }

    .company-info h3 {
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

    .time-posted {
    font-size: 12px;
    color: #888;
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
    .des{
        max-width: 99%; /* hoặc kích thước bạn muốn */
        white-space: nowrap; /* Không xuống dòng */
        overflow: hidden; /* Ẩn nội dung thừa */
        text-overflow: ellipsis; /* Thêm dấu ba chấm */
    }
  .breadcrumb {
    background-color: transparent;
    font-size: 16px;
    display:flex;
    list-style-type:none;
    }
    .breadcrumb-item a {
        text-decoration: none;
        color: black;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }
    .breadcrumb-item, .active {
    font-weight: bold;
    color: #007bff; /* Màu xanh lam */
    }  
</style>
<?php
if(isset($data)&&$data){
    extract($data);
    include_once 'app/views/header.php';
}
?>
<div class="covere">
<div class="head-resCom">
    <h1>Tìm kiếm <span class="highlight">công ty mơ ước</span></h1>
    <p>Tìm những công ty phù hợp nhất với bạn</p>
    <div class="search-bar">
        <input type="text" placeholder="Từ khóa" class="search-input" id="search-input">
        <button class="search-button" id="search-button">Tìm kiếm</button>
    </div>
</div>
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li style="margin-right:10px" class="breadcrumb-item"><a  href="http://localhost/job_finder_website/">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">Trang tìm kiếm công ty</li>
        </ol>
</nav>

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
    <b>Kích cỡ công ty</b>
    <ul class="sidebar-menu">
    <li><label for=""><input  data-size="1" class="filter_size" type="radio" name="size" value="1">1-50</label></li>
    <li><label for=""><input data-size="2" class="filter_size" type="radio"name="size"  value="2">50-100 </label></li>
    <li><label  for=""><input  data-size="3" class="filter_size" type="radio"name="size"  value="3">100-200</label></li>
    <li><label for=""><input data-size="4" class="filter_size" type="radio"name="size"  value="4">200-500</label></li>
    <li><label for=""><input data-size="5"class="filter_size" type="radio"name="size"  value="5">500-1000</label></li>
    <li><label for=""><input data-size="6"class="filter_size" type="radio"name="size"  value="0">Tất cả</label></li>
    </ul>
</aside>
<section class="company-list">
    <h2 style="width:100%;">Kết quả tìm kiếm</h2>
    <div class="company-listI" id="company-listI">
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
    sessionStorage.removeItem('filter_indus');
    let object;
    if(!getSessionStorage('filter_indus')){
        <?php if(!empty($array_filter) && $array_filter):?>
            <?php extract($array_filter);  ?>
        object=
        {
            a: <?php echo json_encode(!empty($industry) ? explode('%', $industry) : []); ?>,
            b: <?php echo json_encode(!empty($size) ? $size : 0); ?>,
            c: <?php echo json_encode(!empty($search) ? $search : null); ?>
        }
        sessionStorage.setItem('filter_indus', JSON.stringify(object));
        <?php else: ?>
            object={ a:[],b:0,c:null};

            sessionStorage.setItem('filter_indus', JSON.stringify(object));
        <?php endif ;?>
    }
    var filter_indus=document.querySelectorAll('.filter_indus');
    // 
    if(getSessionStorage('filter_indus') && getSessionStorage('filter_indus').a.length >0){
        filter_indus.forEach(tag_indus =>{
            let check = getSessionStorage('filter_indus').a.some(num => parseInt(num) == parseInt(tag_indus.dataset.ind));
            if(check){
                tag_indus.checked = true;
            }
        })
    }
    console.log(getSessionStorage('filter_indus'));
    // Hiện màu cho lựu chọn
    displayColorFilterInd();
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
            let object=getSessionStorage('filter_indus');
            if(inp.checked == true){
                object.a.push(parseInt(inp.dataset.ind));
            }else{
                object.a = object.a.filter(num => Number(num) !== Number(inp.dataset.ind));
            } 
            sessionStorage.setItem('filter_indus', JSON.stringify(object));
            displayColorFilterInd();
            fetch('http://localhost/job_finder_website/public/ajax/refreshCompanies.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(getSessionStorage('filter_indus'))
            })
            .then(response => response.text())
            .then(data => {
                try {
                    let jsonData = JSON.parse(data);
                    listCompanyCurrent=jsonData;
                    current_page=1;
                    if(jsonData.length%10 ==0){
                        numPage=Math.floor(jsonData.length/10);
                    }else{
                        numPage=Math.floor(jsonData.length/10)+1;
                    }
                    let ttt=findPsFlPage(jsonData);
                    displayCompanies(ttt);
                    displayPagination();
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            })
            .catch(error => console.error('Fetch error:', error));
        })
    })
    // Lọc theo size
    var filter_size = document.querySelectorAll('.filter_size');
    if(getSessionStorage('filter_indus').b){
        filter_size.forEach( size => {
        if(parseInt(size.dataset.size)==parseInt(getSessionStorage('filter_indus').b)){
            size.checked =true;
        }
    })
    }
    filter_size.forEach( size => {
        size.addEventListener('click', function(){
            if(size.checked==true){
                let object=getSessionStorage('filter_indus');
                if(parseInt(size.value)<1&&parseInt(size.value)>5){
                    object.b=0;
                }else{
                    object.b=parseInt(size.value);
                }
                sessionStorage.setItem('filter_indus', JSON.stringify(object));
                fetch('http://localhost/job_finder_website/public/ajax/refreshCompanies.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(getSessionStorage('filter_indus'))
                })
                .then(response => response.text())
                .then(data => {
                    try {
                        let jsonData = JSON.parse(data);
                        listCompanyCurrent=jsonData;
                        current_page=1;
                        if(jsonData.length%10 ==0){
                            numPage=Math.floor(jsonData.length/10);
                        }else{
                            numPage=Math.floor(jsonData.length/10)+1;
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
        })
    })
    //Load khi tải lại trang
    fetch('http://localhost/job_finder_website/public/ajax/refreshCompanies.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(getSessionStorage('filter_indus'))
    })
    .then(response => response.text())
    .then(data => {
        try {
           // console.log(data);
            let jsonData = JSON.parse(data);
            listCompanyCurrent=jsonData;
            current_page=1;
            if(jsonData.length%10 ==0){
                numPage=Math.floor(jsonData.length/10);
            }else{
                numPage=Math.floor(jsonData.length/10)+1;
            }
            let ttt=findPsFlPage(jsonData);
            displayCompanies(ttt);
            displayPagination();
        } catch (error) {
            console.error('Error parsing JSON:', error);
        }
    })
    .catch(error => console.error('Fetch error:', error));
    //tìm kiếm
    var searchS=document.getElementById('search-button');
    var inputS =document.getElementById('search-input');
    searchS.addEventListener('click',function(){
        let object=getSessionStorage('filter_indus');
        object.c=inputS.value;
        sessionStorage.setItem('filter_indus', JSON.stringify(object));
        fetch('http://localhost/job_finder_website/public/ajax/refreshCompanies.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(getSessionStorage('filter_indus'))
        })
        .then(response => response.text())
        .then(data => {
            try {
                let jsonData = JSON.parse(data);
                listCompanyCurrent=jsonData;
                current_page=1;
            if(jsonData.length%10 ==0){
                numPage=Math.floor(jsonData.length/10);
            }else{
                numPage=Math.floor(jsonData.length/10)+1;
            }
            let ttt=findPsFlPage(jsonData);
            displayCompanies(ttt);
            displayPagination();
            } catch (error) {
                console.error('Error parsing JSON:', error);
            }
        })
        .catch(error => console.error('Fetch error:', error));
    })
    //hàm lấy session
    function getSessionStorage(who){
        const res = JSON.parse(sessionStorage.getItem(who));
        return res
    }
    function getQueryParam(param){
        var urlParam = new URLSearchParams(window.location.search);
        return urlParam.get(param);
    }
    function displayColorFilterInd(){
        let lable_filterSize=document.querySelectorAll('.label_filterSize');
        lable_filterSize.forEach(lab => {
            const inp = lab.querySelector('input');
            if(inp.checked==true){
                lab.style.backgroundColor  ="#b8b8b8";
                lab.style.color="white";
            }else{
                lab.style.backgroundColor  ="inherit";
                lab.style.color="blue";
            }
        })
    }
    function removeElementArray(list,pa){
        var lista=[];
        list.forEach(ele=>{
            if(paraseInt(ele)!=(paraseInt(pa))){
                lista.push(paraseInt(ele));
            }
        })
        return lista
    }
    function displayCompanies(company){
        var liCompany=company
        var boxListC=document.getElementById('company-listI');
        boxListC.innerHTML ="";
        if(liCompany.length>0){
            liCompany.forEach( com =>{
                var liIndustries=<?php echo json_encode($industries); ?>;
                var liJobs=<?php echo json_encode($jobs); ?>;
                for (let ind of liIndustries){
                    if(ind.industry_id==com.industry_id){
                        var inCom=ind.industry_name;
                        break;
                    }
                }
                var listJoC=[];
                if(liJobs.length>0){
                    for (let job of liJobs){
                        if(job.user_id==com.user_id){
                            listJoC.push(job);
                        }
                    }
                }
                var numJoC=listJoC.length;
                boxListC.innerHTML +=
                `
                <a href="http://localhost/job_finder_website/companydetail/companydetail/${com.comp_name}">
                    <div class="company-card">
                        <img src="stripe-logo.png" alt="Stripe" class="company-logo">
                        <div class="company-info">
                            <div style="display:flex;justify-content:space-between;align-items:center;">
                                <h3>${com.comp_name}</h3>
                                <p class="time-posted">${numJoC} công việc</p>
                            </div>
                            <p class="des">${com.comp_description}</p>
                            <div class="tags">
                                <span class="tag">${inCom}</span>
                            </div>
                        </div> 
                    </div>
                </a>
                `
            })
        }
    }
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
    let start=(current_page-1)*10// 2 ở đây số phần tủ sẽ lấy trong một trang, ví dụ một trang có 10 thì là 10
    let end=start+10;//tương tự
    let resLi=list.slice(start,end);
    return resLi;
    }
    function getQueryParam(param){
        var urlParam = new URLSearchParams(window.location.search);
        return urlParam.get(param);
    }
</script>
</body>
</html>