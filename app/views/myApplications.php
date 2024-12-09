<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Của Tôi</title>
    <link rel="stylesheet" href="public/css/myApplication.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container-myProfile">
        <div class="sidebar">
            <div class="top-sidebar">
                <a href="<?php echo BASE_URL; ?>" style="text-decoration: none; color: black;"><h3>JobEverlight</h3></a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>"><i style="padding-left: 10px;" class="fa-solid fa-house"></i> Trang chủ</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/myApplications"><i style="padding-left: 14px;" class="fa-solid fa-file"></i> Đơn ứng tuyển của tôi</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/myProfile/myProfile"><i style="padding-left: 12px;" class="fa-solid fa-user"></i> Hồ sơ của tôi</a></li>
                </ul>
            </div>
            
            <div class="bottom-sidebar">
                <div class="account-bottom-sidebar">
                    <div class="img-account">
                        <img src="../public/img/<?php echo isset($_SESSION['current']['avatar']) ? $_SESSION['current']['avatar'] : 'public/img/default-avatar.png'; ?>" alt="avt-account">
                    </div>

                    <div class="info-account">
                        <h2><?php echo isset($_SESSION['current']) ? $_SESSION['current']['full_name'] : ''; ?></h2>
                        <p><?php echo isset($_SESSION['current']) ? $_SESSION['current']['email'] : ''; ?></p>
                    </div>
                </div>
            </div>
        </div>        
        
        <div class="content-myProfile">
            <div class="myProfile">
                <div class="header-myProfile">
                    <h2>Đơn ứng tuyển của tôi</h2>
                    <a href="<?php echo BASE_URL; ?>" style="text-decoration: none;">
                        <button>Quay lại trang chủ</button>
                    </a>
                </div>

                <form action="process.php" method="POST" enctype="multipart/form-data">
                    <div class="intro-content-myProfile">
                        <h4>Lịch sử ứng tuyển</h4>
                        <table class="application-history">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên công ty</th>
                                    <th>Vị trí</th>
                                    <th>Ngày ứng tuyển</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($applications) && !empty($applications)) {
                                $counter = 1;
                                foreach ($applications as $application) {
                                    ?>
                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td class="company-info">
                                            <?php
                                            // Nếu comp_logo là URL, chỉ cần hiển thị trực tiếp URL này
                                            $logo = isset($application['comp_logo']) && !empty($application['comp_logo']) ? $application['comp_logo'] : 'default_logo.png';
                                            ?>
                                            <img src="<?php echo htmlspecialchars($logo); ?>" alt="Company Logo" style="max-width: 50px; max-height: 50px;">
                                            <span><?php echo htmlspecialchars($application['comp_name']); ?></span>
                                        </td>
                                        <td><?php echo htmlspecialchars($application['job_title']); ?></td>
                                        <td><?php echo htmlspecialchars($application['apply_at']); ?></td>

                                        <?php if ($application['application_status'] == 'Đã chấp nhận'): ?>
                                            <td><span class="status accepted"><?php echo htmlspecialchars($application['application_status']); ?></span></td>
                                        <?php elseif ($application['application_status'] == 'Chờ xử lí'): ?>
                                            <td><span class="status pending"><?php echo htmlspecialchars($application['application_status']); ?></span></td>
                                        <?php elseif ($application['application_status'] == 'Đã từ chối'): ?>
                                            <td><span class="status rejected"><?php echo htmlspecialchars($application['application_status']); ?></span></td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>Không có đơn ứng tuyển nào.</td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
