<?php
    session_start();

    
    if(isset($_SESSION['username']) && ($_SESSION['isLogin']) == true){
        header('Location:dashboar');
    }else{
        header('Location:login');
    }
?>