<?php
// Start session nếu chưa bắt đầu
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
$is_logged_in = isset($_SESSION['current']) && !empty($_SESSION['current']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/homepage.css?v=<?php echo time(); ?>">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Calistoga&family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<?php
    require_once './app/models/jobmodel.php';
?>
<body>
    <!-- Header -->
    <div class="job-header">
        <div class="job-header-container">
            <div class="logo-job-header">

                <img class="logoWebsite" src="public/img/logo_web.jpg" alt="Stripe">
                <span>JobEverlight</span>
                <a class="a1" href="http://localhost/job_finder_website/searchjob/searchjob/industry=,pr=,type=,level=,search=">Tìm việc</a>
                <a class="a2" href="http://localhost/job_finder_website/searchcompany/searchcompany/industry=,size=,search=">Duyệt các công ty</a>
    </div>
    
            <div class="auth-buttons">
                <?php if ($is_logged_in): ?>
                    <!-- Nếu đã đăng nhập, hiển thị thông tin người dùng -->
                    <div id="user-info" class="user-info">
                        <a href="<?php echo BASE_URL; ?>/myProfile/myProfile">

                            <img class="logoAccount" src="<?php echo BASE_URL . '/' . $_SESSION['current']['avatar']; ?>" alt="User Avatar" class="user-avatar">
                        </a>
                        <span id="username" class="username"><?php echo $_SESSION['current']['full_name']; ?></span>
                    </div>
                <?php else: ?>
                    <!-- Nếu chưa đăng nhập, hiển thị nút đăng nhập và đăng ký -->
                    <button id="btn-login" class="btn-login"><a href="<?php echo BASE_URL; ?>login/login">Đăng nhập</a></button>
                    <button id="btn-register" class="btn-register"><a href="<?php echo BASE_URL; ?>login/register">Đăng ký</a></button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="job-banner">
        <div class="job-banner-container">
            <h1>Khám phá hơn 5000+ <br> công việc</h1>
            <img src="https://cdn.prod.website-files.com/6690d5b648b98d802b9b2a05/6690d5b648b98d802b9b2a5d_Homepage%20Hero%20Title%20Pattern.png" alt="">
            <p>Nền tảng tuyệt vời dành cho người tìm việc đang tìm kiếm những đỉnh cao nghề nghiệp mới và đam mê khởi nghiệp.</p>
            <div class="input-search-bar">
                <div class="input-search-detail">
                    <ion-icon name="search-outline"></ion-icon>
                    <input id="searchInput" type="text" placeholder="Tiêu đề công việc hoặc từ khóa">
                </div>

                <button id="searchButton">Tìm kiếm</button>
            </div>
            <script>
                document.getElementById('searchButton').addEventListener('click', function () {
                    const input = document.getElementById('searchInput').value.trim();
                    if (input) {
                        // Chuyển hướng tới trang tìm kiếm và thêm nội dung tìm kiếm vào query string
                        window.location.href = `<?php echo BASE_URL; ?>searchjob/searchjob/industry=,pr=,type=,level=,search=${encodeURIComponent(input)}?`;
                        
                    } else {
                        alert('Vui lòng nhập nội dung tìm kiếm!');
                    }
                });
            </script>
            <span>Phổ biến: UI Designer, UX Researcher, Androi, Admin</span>
        </div>
    </div>

    <div class="logo-companies">
        <div class="logo-companies-container">
            <p>Các công ty chúng tôi đã giúp phát triển</p>
            <div class="brand-logo-companies">
                <img src="https://cdn.prod.website-files.com/6690d5b648b98d802b9b2a05/6690d5b648b98d802b9b2a79_Companies%20Logo%20Vodafone.svg" alt="">
                <img src="https://cdn.prod.website-files.com/6690d5b648b98d802b9b2a05/6690d5b648b98d802b9b2a78_Companies%20Logo%20Intel.svg" alt="">
                <img src="https://cdn.prod.website-files.com/6690d5b648b98d802b9b2a05/6690d5b648b98d802b9b2a5e_Companies%20Logo%20Tesla.svg" alt="">
                <img src="https://cdn.prod.website-files.com/6690d5b648b98d802b9b2a05/6690d5b648b98d802b9b2a77_Companies%20Logo%20AMD.svg" alt="">
                <img src="https://cdn.prod.website-files.com/6690d5b648b98d802b9b2a05/6690d5b648b98d802b9b2a7a_Companies%20Logo%20Talkit.svg" alt="">
            </div>
        </div>
    </div>
    
    <div class="homepage-explore">
        <div class="homepage-explore-container">
            <div class="headline-homepage-explore">
                <h2>Khám phá theo <span>danh mục</span></h2>
                <a href="<?php echo BASE_URL; ?>searchjob/searchjob/industry=,pr=,type=,level=,search=?">
                    <p>Hiển thị tất cả công việc</p>    
                    <ion-icon name="arrow-forward-outline"></ion-icon>
                </a>
            </div>

            <div class="content-homepage-explore">
                <div class="grid-content-homepage-explore">
                    <?php
                        // Kiểm tra xem biến $industries có tồn tại và không rỗng
                        if (isset($industries) && !empty($industries)) {
                            foreach ($industries as $industry) {
                    ?>
                                <a href="<?php echo BASE_URL; ?>searchjob/searchjob/industry=<?php echo $industry['industry_id']; ?> ,pr=,type=,level=,search=?">
                                    <div class="icon">
                                        <i class="fa-solid fa-list"></i>
                                    </div>
                                    
                                    <div class="homepage-explore-name">
                                        <h4><?php echo htmlspecialchars($industry['industry_name']); ?></h4> <!-- Hiển thị tên ngành -->
                                        <div class="homepage-explore-link">
                                            <p><?php echo $industry['job_count']; ?> jobs available</p> <!-- Hiển thị số lượng công việc -->
                                            <ion-icon name="arrow-forward-outline"></ion-icon>
                                        </div>
                                    </div>
                                </a>
                    <?php
                            }
                        } else {
                            echo "No industries available"; // Nếu không có ngành nào
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="homepage-cta">
        <div class="homepage-cta-container">
            <div class="banner-homepage-cta">
                <div class="banner-homepage-cta-text">
                    <h2>Bắt đầu đăng tuyển dụng ngay hôm nay</h2>
                    <p>Bắt đầu đăng tuyển dụng chỉ với 10 đô la.</p>
                    <a href="#">Đăng ký miễn phí</a>
                </div>

                <div class="banner-homepage-cta-image">
                    <img src="https://cdn.prod.website-files.com/6690d5b648b98d802b9b2a05/6690d5b648b98d802b9b2a54_Dashboard%20Company%203.1%20Image.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="lastest-jobs">
    <div class="lastest-jobs-container">
        <div class="headline">
            <h2>Những công việc <span>mới nhất</span></h2>
            <a href="<?php echo BASE_URL; ?>searchjob/searchjob/industry=,pr=,type=,level=,search=?">
                <p>Hiển thị tất cả công việc</p>
                <ion-icon name="arrow-forward-outline"></ion-icon>
            </a>
        </div>
        <div class="content">
            <?php if (!empty($getJobs)): ?>
    <?php foreach ($getJobs as $job): ?>
        <a href="<?php 
            echo BASE_URL; 
            echo "jobDescription?job_id=" . $job['job_id']; 
            if (isset($_SESSION['current']['user_id'])) {
                echo "&user_id=" . $_SESSION['current']['user_id']; 
            } 
        ?>" class="job-card">
            <div class="job-logo">
                <img src="<?php echo $job['comp_logo']; ?>" alt="Logo">
            </div>

            <div class="infor-job-card">
                <h3><?php echo $job['job_title']; ?></h3>
                <p><?php echo $job['comp_name']; ?> 
                    <span>• <?php echo isset($job['comp_address']) ? $job['comp_address'] : 'Chưa xác định'; ?></span>
                </p>
                <div class="job-tags">
                    <?php if ($job['job_type_name'] == 'Fulltime'): ?>
                        <span class="tag-full-time"><?php echo $job['job_type_name']; ?> </span>
                    <?php elseif ($job['job_type_name'] == 'Parttime'): ?>
                        <span class="tag-part-time"><?php echo $job['job_type_name']; ?> </span>
                    <?php else: ?>
                        <span class="tag-internship"><?php echo $job['job_type_name']; ?> </span>
                    <?php endif; ?>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
<?php else: ?>
    <p>No new jobs found.</p>
<?php endif; ?>

        </div>
    </div>
</div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-container">
            <div class="footer-small1-container">
                <div class="intro-small-container">
                    <h2>JobFunny</h2>
                    <p>Dành cho những người tìm việc đam mê khởi nghiệp tìm việc đam mê khởi nghiệp. Tìm công việc mơ ước của bạn dễ dàng hơn.</p>
                </div>

                <div class="category-small-container">
                    <h4>Danh mục</h4>
                    <p>Công ty</p>
                    <p>Giá cả</p>
                    <p>Điều khoản</p>
                    <p>Lời khuyên</p>
                </div>

                <div class="resources-small-container">
                    <h4>Tài nguyên</h4>
                    <p>Hướng dẫn</p>
                    <p>Liên hệ</p>
                    <p>Cập nhật</p>
                    <p>Chính sách bảo mật</p>
                </div>

                <div claas="notifications-small-container">
                    <h4>Nhận thông báo việc làm</h4>
                    <p>Những tin tức, bài viết việc làm mới nhất, được gửi tới hộp thư đến của bạn hàng tuần</p>
                    <input class="input-Email" type="text" placeholder="Địa chỉ Email"> 
                    <button >Đăng ký</button>
                </div>
            </div>

            <div class="footer-small2-container">
                <p>2021@JobFunny. All rights reserved.</p>
                <div class="icon-footer">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-linkedin-in"></i>
                    <i class="fa-brands fa-twitter"></i>
                </div>
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
</body>
</html>