<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
//
 
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$ma="";
$content="";
if (isset($_GET['fa'])){
    $ma=$_SESSION['email'];
    $content="Đây là mã xác nhận tài khoảng của bạn <b>12345</b>";
    $_SESSION['code']="12345";
}else if (isset($_GET['inform'])){
    $ma=$_SESSION['con-email'];
    $content=
    "Xin chào <b>{$_SESSION['con-user'][0]}</b> đã đến với cửa hàng chúng tôi!<br>
    Tài khoảng của bạn: <b>{$_SESSION['con-user'][1]}</b><br>
    Mật khẩu của bạn: <b>{$_SESSION['con-user'][2]}</b><br>
    Email của bạn: <b>{$_SESSION['con-email']} </b>
    ";
}else if (isset($_POST['forget'])){
    $ma=$_SESSION['de_email'];
    $randomNumber = mt_rand(1, 99999);
    $code=$randomNumber."";
    if(strlen($code<5)){
        $sbefor="";
        for($i=0;$i<(5-strlen($code));$i++){
            $sbefor .="0";
        }
        $code = $sbefor . $code;
    }
    $_SESSION['e_code']=$code;
    $content="Đây là mã xác nhận tài khoảng của bạn <b>".$code."</b>";
}
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;// Enable verbose debug output
    $mail->isSMTP();// gửi mail SMTP
    $mail->Host = 'smtp.gmail.com';// Set the SMTP server to send through
    $mail->SMTPAuth = true;// Enable SMTP authentication
    $mail->Username = 'nguyenthong0855@gmail.com';// SMTP username
    $mail->Password = 'mkpltalsuwasrljy'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port = 587; // TCP port to connect to
 
    //Recipients
    $mail->setFrom('nguyenthong0855@gmail.com', 'Mailer');
    $mail->addAddress($ma, 'Joe User'); // Add a recipient
    //$mail->addAddress('ellen@example.com'); // Name is optional
    $mail->addReplyTo('nguyenthong0855@gmail.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
 
    // Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
 
    // Content
    $mail->isHTML(true);   // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body = $content;
    $mail->AltBody = $content;
 
    $mail->send();
    echo 'Message has been sent';
    if(isset($_GET['fa'])){
        //header("location:../project/user/giveAcount.php?fa=success");
        //exit();
        ?>
            <script type="text/javascript">
                window.location = '../project/user/giveAcount.php?fa=success';
            </script>
<?php
    } else if (isset($_GET['inform'])){
        ?>
            <script type="text/javascript">
                window.location = '../project/user/login.php?rs=success';
            </script>
<?php
        unset($_SESSION['con-email']);
        /*header("location:../project/user/login.php?rs=success");
        exit();*/
    }
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>