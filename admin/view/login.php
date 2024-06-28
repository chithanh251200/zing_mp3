<?php
    require_once '../classes/Admin.php'; 
    require_once '../../config/Session.php';

    session_start();
?>

<?php

        if(isset($_POST['btn_submit'])){
            $userLogin = $_POST['username'];
            $passLogin = md5($_POST['password']);

            // khởi tạo đối tượng Admin
            $admin = new Admin();
            $row = $admin -> checkAdmin($userLogin , $passLogin);

            if(!empty($row)){ 

                //set Session
                Session::set('username' , $row['name']);
                Session::set('isLogin' , true);
                
                // redirect
                 header('Location:dashboar');
            }else{
                echo "Khong tồn tại tài khoản !";
            }
        }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng nhập người dùng</title>
    
</head>
<body>
    <h1>Trang login người dùng</h1>
    <form action="login.php" method="POST">
        <label for="username">Tên đăng nhập</label>
        <input type="text" value="" name="username">

        <label for="password">Mật khẩu</label>
        <input type="password" value="" name="password">

        <input type="submit" name="btn_submit" value="Đăng nhập">
        <button id="googleSignInButton">Google</button>
    </form>
</body>
</html>
