<style>
    *{
        box-sizing:border-box;
    }
    .a {
        text-decoration:none;
        color:black;
    }
    html, body{
        height:100vh;
        margin:0;
        padding:0;
        background-color: #f9f9f9;
        display:flex;
        flex-direction:column;
    }
    .rg-parent{
        width:100%;
        display:flex;
        flex-grow:1;
        background-color:inherit;
    }
    .rg-left{
        width:40%;
        height:100%;
        background-image:url(../public/img/log.png);
        background-size:cover;
        background-position:center;
        background-repeat:no-repeat;
    }
    .rg-right{
        width:60%;
        height:100%;
        display:flex;
        flex-direction:column;
        align-items:center;
        background-color:white;
        padding-top:50px;
    }
    .rg-mainPart{
        width:60%;
    }
    .rg-oMainPart{
        padding-top:190px;
    }
    .rg-section{
        width:100%;
        display:flex;
        justify-content:center;
        padding:0 10px;
    }
    .rg-option{
        padding:5px 10px;
        margin:0 10px;
        border-radius:5px;
    }
    .rg-option:hover{
        background:blue;
    }
    .rg-option:hover > a > b{
        color:white;
    }
    .rg-form{
        width:100%;
    }
    .rg-form h1{
        text-align:center;
    }
    .rg-field1{
        width:100%;
        display:flex;
        margin-bottom:15px;
    }
    .rg-field1 input{
        flex:1;
        background:inherit;
        display:inline-block;
        height:30px;
        outline:none;
        border:1px solid gray;
    }
    .rg-industry{
        flex:1;
        background:inherit;
        display:inline-block;
        height:30px;
    }
    .rg-button1{
        width: 100%;
        margin:10px 0;
        padding: 10px 0;
        border-radius:5px;
        color:white;
        background:blue;
        border:none;
    }
    .rg-titleField{
        margin-bottom:5px;
    }
    .rg-button2{
        margin:5px 0;
        padding: 5px 20px;
        margin-left:20px;
        background-color:blue;
        border:none;
        border-radius:5px;
        color:white;
    }
    .rg-progress{
        width: 100%;
        padding:0 30px 40px 30px;
        display:flex;
        justify-content: space-around;
        margin-bottom:20px;
    }
    .rg-State{
        width: 30px;
        height:30px;
        border-radius:50px;
        border:1px solid blue;
        display:flex;
        justify-content:center;
        align-items:center;
        position:relative;
    }
    .rg-statusInfo{
        display:inline-block;
        width:80px;
        position:absolute;
        bottom:-90%;
        left:50%;
        transform: translateX(-50%);
        text-align:center;
    }
    .rg-boxButton{
        width:100%;
        display:flex;
        flex-direction:row-reverse;
        margin:10px 0;
    }
    .background-green{
        background-color:blue !important;
    }
    .border-green{
        border:1px solid blue !important;
    }
    .text-white{
        color:white !important;
    }
    .text-green{
        color:blue !important;
    }
</style>
<?php
if(isset($data)&&$data){
    extract($data);
}
//print_r($data);
if(isset($industry)){
    $resuft=$industry;
}
?>
<div class="rg-parent">
    <div class="rg-left">
        
    </div>
    <div class="rg-right">
        <div class="rg-mainPart">
            <div class="rg-section">
                <div class="rg-option" id="rg-op1"><a class="a" href="?url=register/registerUser"><b id="rg-opB1">Ứng viên</b></a></div>
                <div class="rg-option" id="rg-op2"><a class="a" href="?url=register/registerCompany1"><b id="rg-opB2">Nhà tuyển dụng</b></a></div>
            </div>
            <?php if (isset($check) && $check=="1" ) : ?>
            <form action="?url=register/registerUser" method="POST" name="myForm" class="rg-form" onsubmit="return validateForm();">
                <h1>Đăng ký thành viên</h1>
                <div class="rg-titleField"><b>Họ và tên</b></div>
                <div class="rg-field1">
                    <input type="text" placeholder="Nhập họ và tên" name="rg-fullname" required>
                </div>
                <div class="rg-titleField"><b>Số điện thoại</b></div>
                <div class="rg-field1">
                    <input type="text" placeholder="Nhập sđt" name="rg-phone" required>
                </div>
                <div class="rg-titleField"><b>Email</b></div>
                <div class="rg-field1">
                    <input type="email" placeholder="Nhập email" name="rg-email" required>
                </div>
                <div class="rg-titleField"><b>Mật khẩu</b></div>
                <div class="rg-field1">
                    <input type="password" placeholder="Nhập mật khẩu" name="rg-password" required>
                </div>
                <div class="rg-field1">
                    <input type="password" placeholder="Nhập lại mật khẩu" name="rg-prePassword" required>
                </div>
                <button type="submit" class="rg-button1" name="register1">Đăng ký</button>
            </form>
            <!-- Các bẳng đăng ký cho nhà tuyển dụng -->
            <!-- form1-->
                <?php elseif (isset($check) && $check =="2") :?>
            <form action="?url=register/registerCompany1" method="POST" name="myForm" class="rg-form" onsubmit="return validateForm();">
                <h2>Đăng ký</h2>
                <div class="rg-progress">
                    <div class="rg-State background-green text-white">1 <div class="rg-statusInfo text-green">Liên lạc</div></div>
                    <div class="text-green">. . . . . .</div>
                    <div class="rg-State">2 <div class="rg-statusInfo">Công ty</div></div>
                </div>
                <div class="rg-titleField"><b>Họ và tên</b></div>
                <div class="rg-field1">
                    <input type="text" value="<?php if(isset($_SESSION['loadData'])){echo($_SESSION['loadData'][0]);} ?>" placeholder="Nhập họ và tên" name="rg-fullname" required>
                </div>
                <div class="rg-titleField"><b>Số điện thoại</b></div>
                <div class="rg-field1">
                    <input type="text" value="<?php if(isset($_SESSION['loadData'])){echo($_SESSION['loadData'][1]);} ?>" placeholder="Nhập sđt" name="rg-phone" required>
                </div>
                <div class="rg-titleField"><b>Email</b></div>
                <div class="rg-field1">
                    <input type="email" value="<?php if(isset($_SESSION['loadData'])){echo($_SESSION['loadData'][2]);} ?>" placeholder="Nhập email" name="rg-email" required>
                </div>
                <div class="rg-titleField"><b>Mật khẩu</b></div>
                <div class="rg-field1">
                    <input type="password" value="<?php if(isset($_SESSION['loadData'])){echo($_SESSION['loadData'][3]);} ?>" placeholder="Nhập mật khẩu" name="rg-password" required>
                </div>
                <div class="rg-field1">
                    <input type="password" value="<?php if(isset($_SESSION['loadData'])){echo($_SESSION['loadData'][3]);} ?>" placeholder="Nhập lại mật khẩu" name="rg-prePassword" required>
                </div>
                <div class="rg-boxButton">
                    <button type="submit" class="rg-button2" name="register2">Tiếp theo</button>
                </div>
            </form>
            <!-- form2-->
                <?php elseif (isset($check) && $check=="3") : ?>
            <form action="?url=register/registerCompany2" method="POST" class="rg-form">
                <h2>Đăng ký</h2>
                <div class="rg-progress">
                    <div class="rg-State">1 <div class="rg-statusInfo">Liên lạc</div></div>
                    <div class="text-green">. . . . . .</div>
                    <div class="rg-State background-green text-white">2 <div class="rg-statusInfo  text-green">Công ty</div></div>
                </div>
                <div class="rg-titleField"><b>Tên công ty</b></div>
                <div class="rg-field1">
                    <input type="text" value="<?php if(isset($_SESSION['loadCompany'])){echo($_SESSION['loadCompany'][0]);} ?>" placeholder="Nhập tên công ty" name="rg-companyName" required>
                </div>
                <div class="rg-titleField"><b>Ngành nghề</b></div>
                <div class="rg-field1">
                    <select name="rg-companyIndustry" id="ind" class="rg-industry">
                        <?php
                            if(isset($resuft)&&$resuft){
                                foreach($resuft as $industry){
                                    ?>    
                                        <?php if(isset($_SESSION['loadCompany'])&& $_SESSION['loadCompany'][1]==$industry['industry_id']):?>                                      
                                            <option value="<?php echo($industry['industry_id']);?>" selected><?php echo($industry['industry_name']); ?></option>
                                        <?php else :?>
                                            <option value="<?php echo($industry['industry_id']);?>"><?php echo($industry['industry_name']); ?></option>
                                        <?php endif ;?>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="rg-titleField"><b>Địa chỉ</b></div>
                <div class="rg-field1">
                    <input type="text" value="<?php if(isset($_SESSION['loadCompany'])){echo($_SESSION['loadCompany'][2]);} ?>" placeholder="Nhập trụ sở công ty" name="rg-companyAdress" required>
                </div>
                <div class="rg-boxButton">
                    <button type="submit" class="rg-button2" name="register3">Tiếp theo</button>
                    <button type="submit" class="rg-button2" name="registerBack2" formnovalidate>Quay lại</button>
                </div>
            </form>
            <?php endif ;?>
            <div class="rg-field1">Bạn đã có tài khoản?&nbsp<a href="http://localhost/job_finder_website/login/login">Đăng nhập</a></div>
        </div><!--body-->
    </div><!-- rg-right-->
</div><!--container-->
<script>
    function validateForm() {
        var pass = document.forms["myForm"]["rg-password"].value;
        var confirm_pass = document.forms["myForm"]["rg-prePassword"].value;
        if ( pass != confirm_pass) {
            alert("Bạn phải nhập 2 mật khẩu khớp với nhau!");
            return false;
        }
    }
    var rgOption=document.querySelectorAll('.rg-option');
    rgOption.forEach(fakOp => {
        fakOp.classList.remove('background-green');
        fakOp.classList.remove('border-green');
        fakOp.classList.remove('text-white');
        let anchor = fakOp.querySelector('a');
        if (anchor) {
            anchor.classList.remove('text-white');
        }

        let bold = fakOp.querySelector('a b');
        if (bold) {
            bold.classList.remove('text-white');
        }
    });
    //
    var parameter=getQueryParam('url');
    let res = parameter.split('/');
    if (res &&res[1]=="registerUser"){
        var op1 = document.getElementById('rg-op1');
        op1.classList.add('background-green');
        op1.classList.add('border-green');
        document.getElementById('rg-opB1').classList.add('text-white');
    }else if(res &&res[1]=="registerCompany1"){
        var op2 = document.getElementById('rg-op2');
        op2.classList.add('background-green');
        op2.classList.add('border-green');
        document.getElementById('rg-opB2').classList.add('text-white');
    }else if (res &&res[1]=="registerCompany2"){ 
        var op2 = document.getElementById('rg-op2');
        op2.classList.add('background-green');
        op2.classList.add('border-green');
        document.getElementById('rg-opB2').classList.add('text-white');
    }
    function getQueryParam(param){
        var urlParam = new URLSearchParams(window.location.search);
        return urlParam.get(param);
    }
</script>