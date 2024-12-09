<?php

// require 'vendor/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function sendConfirmationEmail($toEmail, $toAddress, $fullname, $job_name, $time) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pddat2602@gmail.com';
        $mail->Password = 'vufz qpax zuuy rujs'; // Thay bằng mật khẩu ứng dụng
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('pddat2602@gmail.com', 'Thư mời phỏng vấn');
        $mail->addAddress($toEmail, $fullname);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Thư mời phỏng vấn';

        $mail->Body = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f9f9f9;
                    color: #333;
                    margin: 0;
                    padding: 0;
                }
                .email-container {
                    max-width: 600px;
                    margin: 20px auto;
                    padding: 20px;
                    background-color: #ffffff;
                    border-radius: 10px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                .email-header {
                    font-size: 24px;
                    color: #28a745;
                    text-align: center;
                    margin-bottom: 20px;
                }
                .email-body {
                    line-height: 1.6;
                }
                .email-footer {
                    margin-top: 20px;
                    font-size: 12px;
                    color: #888;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='email-header'>Thư mời phỏng vấn</div>
                <div class='email-body'>
                    <p>Xin chào <strong>$fullname</strong>,</p>
                    <p>Chúng tôi rất vui mừng mời bạn tham dự buổi phỏng vấn cho vị trí <strong>$job_name</strong>.</p>
                    <p>Thông tin chi tiết buổi phỏng vấn:</p>
                    <ul>
                        <li><strong>Địa điểm:</strong> $toAddress</li>
                        <li><strong>Thời gian:</strong> $time</li>
                    </ul>
                    <p>Vui lòng phản hồi email này để xác nhận sự tham dự của bạn. Chúng tôi mong được gặp bạn!</p>
                </div>
                <div class='email-footer'>
                    <p>Trân trọng,<br>Đội ngũ tuyển dụng</p>
                </div>
            </div>
        </body>
        </html>
        ";

        // Gửi email
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Lỗi khi gửi email: {$mail->ErrorInfo}";
        return false;
    }
}
