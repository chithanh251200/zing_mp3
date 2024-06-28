
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng nhập người dùng</title>
    <script type="module" src="../asset/js/logginGG.js"></script>
</head>
<body>
    <h1>Trang login người dùng</h1>
    <form action="" method="POST">
        <label for="email">Email</label>
        <input type="text" value="" name="email">

        <label for="password">Mật khẩu</label>
        <input type="password" value="" name="password">

        <input type="submit" name="btn_submit" value="Đăng nhập">
        
    </form>
    <button id="googleSignInButton">Google</button>
    <button id="facebookSignInButton">facebook</button>
</body>
</html>