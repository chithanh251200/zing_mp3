<?php

    session_start();

    if(isset($_SESSION)){
        if(isset($_SESSION['username']) && isset($_SESSION['isLogin'])){
            unset($_SESSION['username']);
            session_destroy();
            header('Location:login');
        }else{
            header('Location:login');
        }
    }

?>