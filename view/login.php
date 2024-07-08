<?php
session_start();

    if(isset($_POST['btn_submit'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];

        if($email){
            setcookie(
                'emailUser',
                $email,
                [
                    'expires' => time() + 50,
                    'path' => '/',
                    'domain' => '', // Set your domain if needed
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'Strict'
                ]
            );

            // set time cho session dong bo ket thuc voi cookie
            ini_set('session.gc_maxlifetime', 50);
            $_SESSION['emailUser'] = $email;

            header("Location:http://localhost:88/chithanh/zing-mp3/index.php");
            exit();
        }else{
            echo 'dang nhap khong thanh cong';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng nhập người dùng</title>
    <script type="module" src="../asset/js/loginSocial.js"></script>
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
    <a href="loginSMS.php">SMS</a>
</body>
</html>
