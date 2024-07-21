<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$vnp_TmnCode = "9IZWFV0M";//Mã website tại VNPAY test Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "NYAOQSMYGXICJJZGEGJBGRZMXQBXAXPR"; //Chuỗi bí mật


$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/vnpay_return.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));



// config JWT xác thực login
define('JWT_SECRET', 'NCT251200');
define('JWT_ISSUER', 'your_issuer');
define('JWT_AUDIENCE', 'your_audience');
define('JWT_EXPIRATION', 3600); // 1 gio


// config JWT code xác thực đăng ký email
define('JWT_SECRET_EMAIL', 'emailCodeJWT');
define('JWT_ISSUER_EMAIL', 'your_issuer');
define('JWT_AUDIENCE_EMAIL', 'your_audience');
define('JWT_EXPIRATION_EMAIL', 3600); // 1 gio


// confix nexmo Vonage 
define('API_KEY', '02c91377');
define('API_SECRET', 'tbD6utUfr2kWQQtb');


// config password ứng dụng Email (https://myaccount.google.com/apppasswords)
define('HOST_EMAIL', 'smtp.gmail.com');
define('USERNAME_EMAIL', 'nguyenchithanh2000.nina@gmail.com');
define('PASS_EMAIL', '02c91377');


?>
