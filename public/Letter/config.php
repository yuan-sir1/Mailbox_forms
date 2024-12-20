<?php
return array(
    'smtp_host' => 'smtp.example.com', // SMTP服务器地址
    'smtp_username' => 'example@example.com', // SMTP用户名
    'smtp_password' => 'password', // SMTP密码
    'smtp_port' => 465, // SMTP端口
    'sender_email' => 'example.com@example.com', // 发件人邮箱地址
    'sender_name' => 'example.com', // 发件人姓名
    'recipients' => array('example@example.com', 'example1@example.com') // 收件人账号列表

    // 确认邮件内容
    'confirmation_subject' => '您提交信息已收到 - Your submission has been received',
    'confirmation_body' => "尊敬的用户您好！\n      我们已然收到您所提交的信息，在此诚挚地感谢您与我们取得联系！我们定会在 24 小时之内给予您回复。\n\n\n Dear users, hello!\n      We have received your submission and thank you for contacting us! We will get back to you within 24 hours. \n\n祝您一切顺利！\nwish you all the best!"
);
?>