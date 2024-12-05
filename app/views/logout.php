<?php
// Bắt đầu session
session_start();

// Huỷ tất cả các session
session_unset();
session_destroy();

// Điều hướng về trang chủ
header("Location: http://localhost/job_finder_website/");
exit();
