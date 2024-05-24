<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// 引入配置文件
require 'config.php';




function sendMail($subject, $body) {
    global $config; // 全局变量

    $mail = new PHPMailer(true);
    try {
        // 配置 SMTP
        $mail->isSMTP();
        $mail->Host = $config['smtp_host']; // 使用配置文件中的 SMTP服务器地址
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp_username']; // 使用配置文件中的 SMTP用户名
        $mail->Password = $config['smtp_password']; // 使用配置文件中的 SMTP密码
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $config['smtp_port'];
        $mail->CharSet = 'UTF-8';
        // 设置发件人
        $mail->setFrom($config['sender_email'], $config['sender_name']); // 使用配置文件中的发件人邮箱地址和姓名

        // 添加收件人
        foreach ($config['recipients'] as $recipient) {
            $mail->addAddress($recipient);
        }

        // 设置邮件内容
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // 发送邮件
        $mail->send();
        // 发送成功后跳转至指定页面
        echo "<script>window.location.href = '../web/success.html';</script>";
        exit; // 结束脚本
    } catch (Exception $e) {
        // 发送失败后跳转至指定页面
        echo "<script>window.location.href = '../web/error.html';</script>";
        exit; // 结束脚本
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $body = "姓名：$name\n邮箱：$email\n主题：$subject\n消息：$message";

    $result = sendMail($subject, $body);

} else {
    echo "无效的请求方法。";
}
?>