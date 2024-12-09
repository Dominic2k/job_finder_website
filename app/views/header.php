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

.job-header-container img {
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius: 20px;
    object-fit: cover;
    top: 15px;
    left: 100px;
}

.job-header-container span {
    position: absolute;
    top: 22px;
    left: 155px;
    font-size: 26px;
    font-weight: bold;
}

.job-header-container .a1 {
    position: absolute;
    top: 27px;
    left: 345px;
    font-size: 16px;
    text-decoration: none;
    color: #515B6F;
}
.job-header-container .a2 {
    position: absolute;
    top: 27px;
    left: 445px;
    font-size: 16px;
    text-decoration: none;
    color: #515B6F;
}
.auth-buttons {
    padding-right: 100px;
}

.auth-buttons button {
    border: none;
    font-size: 15px;;
    width: 100px;
    height: 40px;
    margin: 0 10px;
    font-weight: bold;
}

.auth-buttons .btn-login {
    color: #4640DE;
    background-color: white;
    cursor: pointer;
}

.auth-buttons .btn-register {
    color: white;
    background-color: #4640DE;
    cursor: pointer;
}
</style>
<div class="job-header">
        <div class="job-header-container">
            <div class="logo-job-header">
                <img src="../../public/img/logo_web.jpg" alt="Stripe">
                <span>JobEverlight</span>
                <a class="a1" href="http://localhost/job_finder_website/searchjob/searchjob/industry=,pr=,type=,level=,search=">Tìm việc</a>
                <a class="a2" href="http://localhost/job_finder_website/searchcompany/searchcompany/industry=,size=,search=">Duyệt các công ty</a>
            </div>
    
            <div class="auth-buttons" >
                <button id="btn-login" class="btn-login">Đăng nhập</button>
                <button id="btn-register" class="btn-register">Đăng ký</button>
            </div>
            <div id="user-info" class="user-info" style="display:none;">
                <img src="https://via.placeholder.com/40" alt="User Avatar" class="user-avatar">
                <span id="username" class="username">Tên người dùng</span>
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