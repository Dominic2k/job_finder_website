<style>
    .job-header {
    position: fixed;
    width: 100vw;
    height: 70px;
    z-index: 1000;
    background-color: #e0e7ff;
    /* background-color: #F8F8FD; */
    /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
}

.job-header-container {
    height: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.job-header-container > div > a > img {
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius: 20px;
    object-fit: cover;
    top: 15px;
    left: 50px;
}

.job-header-container > div > span {
    position: absolute;
    top: 15px;
    left: 105px;
    font-size: 26px;
    font-weight: bold;
}

.job-header-container .a1 {
    position: absolute;
    top: 23px;
    left: 345px;
    font-size: 16px;
    text-decoration: none;
    color: #515B6F;
}
.job-header-container .a2 {
    position: absolute;
    top: 23px;
    left: 445px;
    font-size: 16px;
    text-decoration: none;
    color: #515B6F;
}
.auth-buttons {
    padding-right: 50px;
}
.user-info{
    width: 200px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.auth-buttons .btn-login {
    background-color: #ffe4af;
    padding: 0px 10px;
    cursor: pointer;
    border-radius:5px;
    border:none;
    width: 100px;
    height: 40px;
}
.auth-buttons .btn-login a{
    color:white;
}
.auth-buttons .btn-register {
    color: white;
    padding: 0px 10px;
    background-color: #4640DE;
    cursor: pointer;
    border-radius:5px;
    border:none;
    width: 100px;
    height: 40px;
}
a {
    text-decoration: none;
}
.auth-buttons .btn-register a{
    color:white;
}
.auth-buttons .username {
    width: 80px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;

    font-size: 20px;
}

.auth-buttons .logoAccount {
    width: 40px;
    height: 40px;
    border-radius: 20px;
    object-fit: cover;
} 
</style>
<div class="job-header">
        <div class="job-header-container">
            <div class="logo-job-header">
                <a href="http://localhost/job_finder_website"><img src="../../public/img/logo_web.jpg" alt="Stripe"></a>
                <span>JobEverlight</span>
                <a class="a1" href="http://localhost/job_finder_website/searchjob/searchjob/industry=,pr=,type=,level=,search=">Tìm việc</a>
                <a class="a2" href="http://localhost/job_finder_website/searchcompany/searchcompany/industry=,size=,search=">Duyệt các công ty</a>
            </div>
    
            <div class="auth-buttons" >
                <?php $is_logged_in = isset($_SESSION['current']) ?isset($_SESSION['current'])  : 0;if (!empty($is_logged_in)): ?>
                    <!-- Nếu đã đăng nhập, hiển thị thông tin người dùng -->
                    <div id="user-info" class="user-info">
                        <span id="username" class="username"><?php echo $_SESSION['current']['full_name']; ?></span>
                        <a href="<?php echo BASE_URL; ?>/myProfile/myProfile">

                            <img class="logoAccount" src="<?php echo BASE_URL . '/' . $_SESSION['current']['avatar']; ?>" alt="User Avatar" class="user-avatar">
                        </a>
                    </div>
                <?php else: ?>
                    <!-- Nếu chưa đăng nhập, hiển thị nút đăng nhập và đăng ký -->
                    <button id="btn-login" class="btn-login"><a href="<?php echo BASE_URL; ?>login/login">Đăng nhập</a></button>
                    <button id="btn-register" class="btn-register"><a href="<?php echo BASE_URL; ?>register/registerUser">Đăng ký</a></button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
    const loginBtn = document.getElementById('btn-login');
    const registerBtn = document.getElementById('btn-register');
    loginBtn.addEventListener('click', function () {
        window.location.href = "http://localhost/job_finder_website/login/login";
    });
    registerBtn.addEventListener('click', function () {
        window.location.href = "http://localhost/job_finder_website/register/registerUser";
    }
    );
</script>