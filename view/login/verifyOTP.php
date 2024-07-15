<?php

    require '../../vendor/autoload.php';

    session_start();


    //Khởi tạo Thư viện
    $basic  = new \Vonage\Client\Credentials\Basic("02c91377", "tbD6utUfr2kWQQtb");
    $client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

    // xác thực code SMS
    if (isset($_POST['Verify'])) {

        $codeOTP = $_POST['codeOTP'];
        // echo $userOTP;

        // Lấy request_id từ session để xác thực code otp
        $requestId = $_SESSION['verify_request_id'];


        try {
            // Xác thực mã OTP với Twilio Verify
            $result = $client->verify()->check($requestId, $codeOTP);
            // var_dump($result->getResponseData());

            if ($result->getStatus() == 0) {
                echo 'OTP verified successfully! chi thanh test';
                // Xử lý các hành động tiếp theo sau khi xác thực thành công
            } else {
                echo 'Invalid OTP. Please try again.';
            }
        } catch (\Exception $e) {
            // echo 'error'.e->getMessage();
            echo 'Error: Vui lòng nhập mã OTP để xác thực !' ;
        }
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
    <h1>Vui lòng nhập mã OTP để xác thực tài khoản</h1>
    <form action="" method="post">
        <label for="codeOTP">Xác nhận mã OTP</label>
        <input type="text" value="" id="codeOTP" name="codeOTP">
        <span id="countdown"></span>
        <input type="submit" id="Verify" name="Verify" value="Xác thực">
    </form>
    <script>
        // Thời gian đếm ngược tính bằng giây
        let countdownTime = 5; // 10s

        // Lấy phần tử để hiển thị đồng hồ đếm ngược
        const countdownElement = document.getElementById('countdown');

        // Hàm để cập nhật đồng hồ đếm ngược
        function updateCountdown() {
            // Tính toán số phút và giây còn lại
            const minutes = Math.floor(countdownTime / 60);
            const seconds = countdownTime % 60;

            // Hiển thị thời gian còn lại với định dạng MM:SS
            countdownElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            // Giảm thời gian đếm ngược
            countdownTime--;

            // Kiểm tra nếu thời gian đã hết
            if (countdownTime < 0) {
                clearInterval(countdownInterval);
                countdownElement.textContent = "Mã OTP hết hạn!";
            }
        }

        // Cập nhật đồng hồ đếm ngược mỗi giây
        const countdownInterval = setInterval(updateCountdown, 1000);

        // Gọi hàm updateCountdown() ngay lập tức để hiển thị thời gian ban đầu
        updateCountdown();

    </script>
</body>