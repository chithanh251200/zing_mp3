<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng nhập người dùng</title>
    <script type="module" src="../asset/js/loginSocial.js"></script>
</head>
<body>
    <h1>Đăng nhập bằng số điện thoại</h1>
    <label for="phone">số điện thoại</label>
    <input type="text" value="" id="phone" name="phone">
    <button id="sendSMS">Gữi mã xác thực</button><br>

    <label for="codeSMS">Xác nhận mã code</label>
    <input type="text" value="" id="codeSMS" name="codeSMS">
    <button id="loginSMS">Đăng nhập</button>
</body>
</html>