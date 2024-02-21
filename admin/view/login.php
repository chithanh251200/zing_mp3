<?php
    include '../classes/Admin.php'; 
    include_once '../../config/Session.php';

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
    <title>Trang đăng nhập</title>
    
</head>
<body>
    <h1>Trang login</h1>
    <form action="login.php" method="POST">
        <label for="username">Tên đăng nhập</label>
        <input type="text" value="" name="username">

        <label for="password">Mật khẩu</label>
        <input type="password" value="" name="password">

        <input type="submit" name="btn_submit" value="Đăng nhập">
        <button onclick = "handelGoogle">Google</button>
    </form>
</body>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-analytics.js";
        
        // Add Firebase products that you want to use
        import { getAuth ,signInWithPopup , GoogleAuthProvider  } from 'https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js';
        import { getFirestore } from 'https://www.gstatic.com/firebasejs/10.8.0/firebase-firestore.js';

        const firebaseConfig = {
            apiKey: "AIzaSyABrdRvmExHlsjAaXj8v2lUBqojmWg8_GI",
            authDomain: "zing-mp3-d2229.firebaseapp.com",
            projectId: "zing-mp3-d2229",
            storageBucket: "zing-mp3-d2229.appspot.com",
            messagingSenderId: "734057184662",
            appId: "1:734057184662:web:b993bb92617409b31931b7",
            measurementId: "G-EPBHRQGEDD"
        };

        // Initialize Firebase
        const firebaseApp = initializeApp(firebaseConfig);
        const analytics = getAnalytics(firebaseApp);
        const auth = getAuth(firebaseApp);
        var google = new GoogleAuthProvider();

        function handelGoogle() {
            return signInWithPopup(auth, google)
            .then((result) => {
            // This gives you a Google Access Token. You can use it to access the Google API.
            const credential = GoogleAuthProvider.credentialFromResult(result);
            const token = credential.accessToken;
            // The signed-in user info.
            const user = result.user;
            // IdP data available using getAdditionalUserInfo(result)
            // ...
            }).catch((error) => {
            // Handle Errors here.
            const errorCode = error.code;
            const errorMessage = error.message;
            // The email of the user's account used.
            const email = error.customData.email;
            // The AuthCredential type that was used.
            const credential = GoogleAuthProvider.credentialFromError(error);
            // ...
            });

        }
        // handelGoogle();

    </script>
</body>
</html>