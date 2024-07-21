<?php

    require '../../vendor/autoload.php';
    require '../../config/config.php';


    //Khởi tạo Thư viện
    $basic  = new \Vonage\Client\Credentials\Basic(API_KEY, API_SECRET);
    $client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));


    // Use the Client to make requests to the Twilio REST API
    if(isset($_POST['sendSMS'])){

        // Số điện thoại người dùng
        $smsOPT = $_POST['phone'];
        // bỏ số 0 để đúng định dạng phone trên hệ thống VONAGE
        $newSmsOtp = substr($smsOPT, 1);

        // tạo số điện thoại cho phù hợp với hệ thống VONAGE (hệ thống SMS)
        $phoneNumber = '84'.$newSmsOtp;
        // echo $phoneNumber;

        // Gửi yêu mã OPT sến số điện thoại SMS
        $request = new \Vonage\Verify\Request($phoneNumber, "Vonage");
        $response = $client->verify()->start($request);

        // Lưu mã request_id vào session để sử dụng sau này xác thực mã code
        session_start();
        ini_set('session.gc_maxlifetime', 180); // 3 phút
        $_SESSION['verify_request_id'] = $response->getRequestId();

        // Chuyển hướng người dùng đến trang nhập OTP
        header('Location: verifyOTP.php');

        // echo 'OTP sent successfully!' . $response->getRequestId();

    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang xác thực SMS OTP</title>
</head>
<body>
    <h1>Vui lòng xác thực tài khoản  bảo mật cấp 2 bằng SMS</h1>
    <form action="" method="post">
        <label for="phone">Nhập số điện thoại</label>
        <input type="text" value="" id="phone" name="phone" value="+84">
        <input type="submit" id="sendSMS" name="sendSMS" value="Gữi mã xác thực">
    </form>
</body>