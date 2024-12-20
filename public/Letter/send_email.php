<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// 引入配置文件
$config = require 'config.php';

function sendMail($subject, $body, $userEmail) {
    global $config;

    $mail = new PHPMailer(true);
    try {
        // 配置 SMTP
        $mail->isSMTP();
        $mail->Host = $config['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp_username'];
        $mail->Password = $config['smtp_password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $config['smtp_port'];
        $mail->CharSet = 'UTF-8';

        // 设置发件人
        $mail->setFrom($config['sender_email'], $config['sender_name']);

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

        // 发送成功后发送确认邮件给用户
        sendConfirmationMail($userEmail);

        // 发送成功后跳转至指定页面
        echo "<script>window.location.href = '../web/success.php';</script>";
        exit;
    } catch (Exception $e) {
        // 发送失败时仅跳转至错误页面，不保存任何错误信息
        echo "<script>window.location.href = '../web/error.php';</script>";
        exit;
    }
}

function sendConfirmationMail($userEmail) {
    global $config;

    $mail = new PHPMailer(true);
    try {
        // 配置 SMTP
        $mail->isSMTP();
        $mail->Host = $config['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp_username'];
        $mail->Password = $config['smtp_password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $config['smtp_port'];
        $mail->CharSet = 'UTF-8';

        // 设置发件人
        $mail->setFrom($config['sender_email'], $config['sender_name']);

        // 添加用户邮箱
        $mail->addAddress($userEmail);

        // 设置确认邮件内容
        $mail->isHTML(false);
        $mail->Subject = $config['confirmation_subject'];
        $mail->Body = $config['confirmation_body'];

        // 发送确认邮件
        $mail->send();
    } catch (Exception $e) {
        // 不保存任何日志或错误信息
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // 检查特殊字符
    if (strpos($name, '<') !== false || strpos($name, '>') !== false || strpos($subject, '<') !== false || strpos($subject, '>') !== false || strpos($message, '<') !== false || strpos($message, '>') !== false) {
        echo "<script>alert('请勿输入特殊字符！'); window.location.href = '../';</script>";
        exit;
    }

    $body = "姓名：$name\n邮箱：$email\n主题：$subject\n消息：$message";

    sendMail($subject, $body, $email);
} else {
    echo "对不起，您使用了无效的请求方法。";
    echo "<script> setTimeout(function () { window.location.href = '../'; }, 3000); </script>";
}
?>