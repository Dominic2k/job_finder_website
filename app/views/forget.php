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
<div class="rg-parent">
    <div class="rg-left">
        
    </div>
    <div class="rg-right  rg-oMainPart">
        <div class="rg-mainPart">
            <?php if(isset($data['check'])&&$data['check']==1): ?>
            <form action="http://localhost/job_finder_website/forget/forget" method="POST" name="myForm" class="rg-form">
                <h1>Nhập vào Email của bạn!</h1>
                <div class="rg-titleField"><b>Email</b></div>
                <div class="rg-field1">
                    <input type="email" placeholder="Nhập email" name="rg-email" required>
                </div>
                <button type="submit" class="rg-button1" name="forget">Tiếp tục</button>
            </form>
            <?php endif ; ?>
            <?php if(isset($data['check'])&&$data['check']==2) : ?>
                <form action="http://localhost/job_finder_website/forget/forget2" method="POST" name="myForm" class="rg-form" onsubmit="return validateForm();">
                    <h1>Nhập vào mã xác nhận!</h1>
                    <div class="rg-titleField"><b>Code</b></div>
                    <div class="rg-field1">
                        <input type="text" placeholder="Nhập mã" name="code" required>
                    </div>
                    <div class="rg-titleField"><b>Mật khẩu</b></div>
                    <div class="rg-field1">
                        <input type="password" placeholder="Nhập mật khẩu" name="de_pass" required>
                    </div>
                    <div class="rg-titleField"><b>Mật lại khẩu</b></div>
                    <div class="rg-field1">
                        <input type="password" placeholder="Nhập lại mật khẩu" name="de_pass2" required>
                    </div>
                    <button type="submit" class="rg-button1" name="forget2">Xác nhận</button>
                </form>
            <?php endif ;?>
        </div><!--body right-->
    </div><!-- rg-right-->
</div><!--container-->
<script>
    function validateForm() {
        var pass = document.forms["myForm"]["de_pass"].value;
        var confirm_pass = document.forms["myForm"]["de_pass2"].value;
        if ( pass != confirm_pass) {
            alert("Bạn phải nhập 2 mật khẩu khớp với nhau!");
            return false;
        }
    }
</script>