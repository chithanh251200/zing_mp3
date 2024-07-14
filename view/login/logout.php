<?php
    session_start();

    // Hủy bỏ session
    session_destroy();

    // Xóa các cookie khác (nếu có)
    setcookie('accountLogin', '', time() - 3600, '/');

    // Chuyển hướng người dùng đến trang đăng nhập hoặc trang chủ
    header('Location: http://localhost:88/chithanh/zing-mp3/index.html');
    exit();

?>
