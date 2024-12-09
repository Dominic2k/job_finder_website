<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Công Việc</title>
    <link rel="stylesheet" href="public/css/jobDescription.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Calistoga&family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <!-- Header -->
    <div class="job-header">
        <a class="WebFunny" href="<?php echo BASE_URL; ?>">
            <img src="public/img/logoWebsite.jpg" alt="JobFunny">
            <span>JobFunny</span>

        </a>

        <a class="findJobs href="#">Tìm việc</a>

        <!-- <div class="auth-buttons">
            <button class="btn-login">Đăng nhập</button>
            <button class="btn-register">Đăng ký</button>
        </div> -->
    </div>

    <!-- Job Overview -->
    <div class="job-details">
        <div class="job-overview">
            <div class="job-summary">
                <div class="left-job-summary">
                    <img src="<?php echo $job['comp_logo'] ?>" alt="logo-company">
                    <div class="info-job-summary">
                        <h2><?php echo $job['job_title'] ?></h2>
                        <p><?php echo $job['comp_name'] ?> • <?php echo $job['comp_address'] ?> • <?php echo $job['job_type_name'] ?></p>
                    </div>
                </div>

                <div class="right-job-summary">
                    <!-- <i class="fas fa-share-alt"></i>
                    <div class="behind-line"></div> -->
                    <button id="applyBtn" class="btn-apply">Nộp</button>
                </div>
            </div>
        </div>

        <!-- Benefits -->
        <div class="job-benefits">
            <div class="intro-job-benefits">
                <h2>Quyền lợi & Lợi ích</h2>
                <span>Công việc này đi kèm với một số đặc quyền và lợi ích</span>
            </div>

            <div class="details-job-benefits">
                <div class="left-job-details-benefits">
                    <i class="fa-solid fa-stethoscope"></i>
                    <h3>Chăm sóc sức khỏe đầy đủ</h3>
                    <p>Chúng tôi tin và những cộng đồng thịnh vượng và điều đó bắt đầu từ việc nhóm của chúng tôi hạnh phúc và khỏe mạnh</p>
                </div>

                <div class="middle-job-details-benefits">
                    <i class="fa-solid fa-water-ladder"></i>
                    <h3>Kỳ nghỉ không giới hạn</h3>
                    <p>Chúng tôi tin rằng bạn nên có một lịch trình linh hoạt để tạo không gian cho gia đình, sức khỏe và niềm vui.</p>
                </div>

                <div class="right-job-details-benefits">
                    <i class="fa-solid fa-camera"></i>
                    <h3>Phát triển kỹ năng</h3>
                    <p>Chúng tôi tin vào việc luôn học hỏi và nâng cao kỹ năng của mình. Cho dù đó là một hội nghị hay khóa học trực tuyến.</p>
                </div>
            </div>
            <!-- 
            <div class="benefits-list">
                <div class="benefit-item">
                    <i class="fas fa-stethoscope"></i>
                    <p><strong>Chăm sóc sức khỏe đầy đủ</strong></p>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-plane"></i>
                    <p><strong>Kỳ nghỉ không giới hạn</strong></p>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <p><strong>Phát triển kỹ năng</strong></p>
                </div>
            </div> -->
        </div>

        <!-- Job Description -->
        <div class="job-description">
            <div class="details-job-description">
                <h2>Mô tả</h2>
                <p>Stripe đang tìm kiếm chuyên gia Tiếp thị truyền thông xã hội để giúp quản lý mạng trực tuyến của chúng tôi. Bạn sẽ chịu trách nhiệm giám sát các kênh truyền thông xã hội của chúng tôi, tạo nội dung, tìm ra những cách hiệu quả để thu hút cộng đồng và khuyến khích người khác tham gia trên các kênh của chúng tôi.</p>
            </div>

            <div class="details-job-description">
                <h2>Trách nhiệm</h2>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Sự tham gia của cộng đồng để đảm bảo điều đó được hỗ trợ và đại diện tích cực trực tuyến</p>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Tập trung vào phát triển và xuất bản nội dung truyền thông xã hội</p>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Hỗ trợ tiếp thị và chiến lược</p>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Luôn cập nhật các xu hướng trên nền tảng truyền thông xã hội và đề xuất ý tưởng nội dung cho nhóm</p>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Tương tác với cộng đồng trực tuyến</p>
            </div>

            <div class="details-job-description">
                <h2>Bạn là ai</h2>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Bạn nhận được năng lượng từ mọi người và xây dựng môi trường làm việc lý tưởng</p>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Bạn có ý thức về không gian đẹp và trải nghiệm văn phòng</p>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Bạn là một người quản lý văn phòng tự tin, sẵn sàng đảm nhận thêm trách nhiệm</p>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Bạn là người có định hướng chi tiết và sáng tạo</p>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Bạn là nhà tiếp thị tăng trưởng và biết cách chạy chiến dịch</p>
            </div>

            <div class="details-job-description">
                <h2>Những điều cần có</h2>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Thông thạo tiếng Anh</p>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Kỹ năng quản lý dự án</p>
                <p><span><ion-icon name="checkmark-circle-outline"></ion-icon></span>Sao chép kỹ năng chỉnh sửa</p>
            </div>
            <!-- <h2>Mô tả</h2>
            <p>Stripe đang tìm kiếm chuyên gia Tiếp thị truyền thông xã hội...</p> -->
        </div>
    </div>

    <!-- Company Info Section -->
    <div class="company-info">
        <div class="company-description">
            <div class="top-company-description">
                <img src="<?php echo $job['comp_logo'] ?>" alt="logo_company">

                <div class="moreInfo-company">
                    <h3><?php echo $job['comp_name'] ?></h3>
                    <a href="<?php echo BASE_URL; ?>searchcompany/searchcompany/industry=<?php echo $job['comp_id'];?>,size=,search=" class="read-more">Đọc thêm về <?php echo $job['comp_name'] ?> <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="bottom-company-description">
                <p>Stripe là một công ty công nghệ xây dựng cơ sở hạ tầng kinh tế cho Internet. Các doanh nghiệp thuộc mọi quy mô - từ các công ty khởi nghiệp mới đến các công ty đại chúng - sử dụng phần mềm của chúng tôi để chấp nhận thanh toán và quản lý doanh nghiệp của họ trực tuyến.</p>
            </div>
        </div>

        <div class="company-images">
            <img class="main-company-images" src="https://japan-itworks.vn/storage/media/tinymce/blog/1628560382-1628560382-435.jpg" alt="Image 1">
            <div class="small-company-images">
                <img src="https://weconnect.co/wp-content/uploads/2019/11/services-leadJapan.jpg" alt="Image 2">
                <img src="https://weconnect.co/wp-content/uploads/2019/11/services-leadJapan.jpg" alt="Image 3">
            </div>
        </div>
    </div>

    <!-- Similar Jobs -->
    <div class="similar-jobs">
        <div class="similar-job-container">
        <div class="header-similar-jobs">
            <h2>Những công việc <span>tương tự</span></h2>
            <a href="<?php echo BASE_URL; ?>searchjob/searchjob/industry=,pr=,type=,level=,search=?" class="show-more-jobs">Hiển thị tất cả công việc <i class="fas fa-arrow-right"></i></a>
        </div>
    
        <div class="job-grid">
            <?php if (!empty($similarJobs)): ?>
                <?php foreach ($similarJobs as $similarJob): ?>
                <a href="#" class="job-card">
                <div class="job-logo">
                    <img src="<?php echo $similarJob['comp_logo']; ?>" alt="Logo">
                </div>
                <div class="infor-job-card">
                    <h3><?php echo $similarJob['job_title']; ?></h3>
                    <p><?php echo $similarJob['comp_name']; ?>
                        <span>• <?php echo isset($similarJob['comp_address']) ? $similarJob['comp_address'] : 'Chưa xác định'; ?></span>
                    </p>
                    <div class="job-tags">
                        <?php if ($similarJob['job_type_name'] == 'Fulltime'): ?>
                            <span class="tag-full-time"><?php echo $similarJob['job_type_name']; ?></span>
                        <?php elseif ($similarJob['job_type_name'] == 'Parttime'): ?>
                            <span class="tag-part-time"><?php echo $similarJob['job_type_name']; ?></span>
                        <?php else: ?>
                            <span class="tag-internship"><?php echo $similarJob['job_type_name']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No similar jobs found.</p>
        <?php endif; ?>
        </div>
    </div>
</div>
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

    <!-- Overlay mờ -->
    <div class="overlay" style="display: none;"></div>

    <div class="myApplicationDetail-container">
    <div class="myApplicationDetail-small-container">
        <!-- Thông tin công việc -->
        <div class="info-job-myApplicationDetail">
            <div class="job-logo"><img src="<?php echo $data['job']['comp_logo']; ?>" alt="logo_company"></div>
            
            <div class="infor-job-card">
                <h3><?php echo $data['job']['job_title']; ?></h3>
                <p><?php echo $data['job']['comp_name']; ?><span>• <?php echo $data['job']['comp_address']; ?></span> <span>• <?php echo $data['job']['job_type_name']; ?></span></p>
            </div>
        </div>

        <!-- Thông tin cá nhân và form nộp đơn -->
        <div class="info-personal-myApplicationDetail">
        <form action="<?php echo BASE_URL . 'jobDescription/submitApplication'; ?>" method="POST" enctype="multipart/form-data" name="myApplyForm" class="rg-applyform">
    <!-- Các trường thông tin cá nhân -->
    <div class="info-personal">
        <h4 class="full_name">Họ và tên</h4>
        <input type="text" class="fullname" placeholder="Nhập họ và tên" value="<?php echo htmlspecialchars($data['user_info']['full_name']); ?>" readonly>
    </div>
    <div class="info-personal">
        <h4 class="email">Email</h4>
        <input type="text" class="email" placeholder="Nhập email" value="<?php echo htmlspecialchars($data['user_info']['email']); ?>" readonly>
    </div>
    <div class="info-personal">
        <h4 class="phone">Số điện thoại</h4>
        <input type="text" class="phoneNumber" placeholder="Nhập số điện thoại" value="<?php echo htmlspecialchars($data['user_info']['phone']); ?>" readonly>
    </div>

    <!-- Đính kèm CV -->
    <div class="attachVC">
        <h3>Đính kèm CV của bạn</h3>
        <div class="attachCV-Detail">
            <!-- <i class="fa-solid fa-paperclip"></i> -->
            <input type="file" name="cv_file" accept="application/pdf" class="cv-input" required>
            <p>Chọn file CV (Chỉ hỗ trợ PDF)</p>
        </div>
    </div>

    <!-- Trường ẩn chứa job_id và user_id -->
    <input type="hidden" name="job_id" value="<?php echo $data['job']['job_id']; ?>">
    <input type="hidden" name="user_id" value="<?php echo $data['user_info']['user_id']; ?>">

    <!-- Nút Nộp Đơn -->
    <div class="buttonSubmit">
        <button type="submit" name="submit_application" class="submit">Nộp Đơn</button>
    </div>

    <p>By sending the request you can confirm that you accept our Terms of Service and Privacy Policy</p>
</form>

            <?php
                // Nếu có thông báo thành công hoặc lỗi, hiển thị nó trực tiếp
                if (isset($data['message'])) {
                    echo '<div class="message">' . $data['message'] . '</div>';
                }
            ?>
        </div>
    </div>
</div>

<script>
    // Lắng nghe sự kiện khi nút "Nộp" được nhấn
    document.getElementById('applyBtn').addEventListener('click', function() {
        // Lấy phần tử lớp phủ và form ứng tuyển
        const overlay = document.querySelector('.overlay');
        const applicationForm = document.querySelector('.myApplicationDetail-container');

        // Hiển thị lớp phủ và form ứng tuyển
        overlay.style.display = 'block';
        applicationForm.style.display = 'block';
    });

    // Thêm sự kiện để đóng form khi nhấn vào lớp phủ (overlay)
    document.querySelector('.overlay').addEventListener('click', function() {
        const overlay = document.querySelector('.overlay');
        const applicationForm = document.querySelector('.myApplicationDetail-container');

        // Ẩn lớp phủ và form ứng tuyển
        overlay.style.display = 'none';
        applicationForm.style.display = 'none';
    });
</script>

</body>
</html>
