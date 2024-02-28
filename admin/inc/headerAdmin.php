<?php
    session_start();

    if(isset($_SESSION)){
        if(!isset($_SESSION['username']) && !isset($_SESSION['isLogin'])){
            header('Location:login');
            die();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Trang quản lý hệ thống</title>
</head>
<body>
    <h1>Trang quản lý</h1>
    <h1>Ten account : <?php  echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></h1>
    <a href="logout.php">Đăng xuất</a>
