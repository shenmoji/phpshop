<?php
// 实例化
include "class.phpmailer.php";
$pm = new PHPMailer();

// 服务器相关信息
$pm->Host = 'smtp.163.com'; // SMTP服务器
$pm->IsSMTP(); // 设置使用SMTP服务器发送邮件
$pm->SMTPAuth = true; // 需要SMTP身份认证
$pm->Username = 'luo2321123809'; // 登录SMTP服务器的用户名
$pm->Password = '13855827274lt'; //授权码 登录SMTP服务器的密码

// 发件人信息
$pm->From = 'luo2321123809@163.com';
$pm->FromName = '墨迹221';

// 收件人信息
$pm->AddAddress('2321123809@qq.com', '测试221'); // 添加一个收件人
//$pm->AddAddress('wangwei2@itcast.cn', 'wangwei2'); // 添加另一个收件人


$pm->CharSet = 'utf-8'; // 内容编码
$pm->Subject = '测试..'; // 邮件标题
$pm->MsgHTML('欢迎来到<a href="http://www.itcast.cn" target="_blank">绝望的测试？</a>！'); // 邮件内容

// 发送邮件
if($pm->Send()){
   echo 'ok';
}else {
   echo $pm->ErrorInfo;
}