<?php
    require_once '../classes/Admin.php';
    
    $loginGG = new Admin();

    $data = json_decode(file_get_contents("php://input"), true);
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    // $loginGG -> registerGG($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng kí tài khoản</title>
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js"></script>
</head>
<body>
    
    <h1>Trang đăng kí người dùng</h1>
    <form action="" method="POST">
        <label for="username">Tên đăng kí</label>
        <input type="text" value="" name="username">

        <label for="password">Mật khẩu</label>
        <input type="password" value="" name="password">

        <input type="submit" name="btn_submit" value="Đăng kí">

        <button onclick="handelGoogle" id="googleSignInButton">Google</button>
    </form>

   

    <script>
       
        var firebaseConfig = {
            apiKey: "AIzaSyABrdRvmExHlsjAaXj8v2lUBqojmWg8_GI",
            authDomain: "zing-mp3-d2229.firebaseapp.com",
            projectId: "zing-mp3-d2229",
            storageBucket: "zing-mp3-d2229.appspot.com",
            messagingSenderId: "734057184662",
            appId: "1:734057184662:web:b993bb92617409b31931b7",
            measurementId: "G-EPBHRQGEDD"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        function handelGoogle() {
            var provider = new firebase.auth.GoogleAuthProvider();
            firebase.auth().signInWithPopup(provider).then((result) => {
                var user = result.user;
                // Gửi dữ liệu người dùng tới server PHP
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "register.php", true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log("User data saved successfully");
                    }
                };
                xhr.send(JSON.stringify({
                    uid: user.uid,
                    name: user.displayName,
                    email: user.email,
                    profilePicture: user.photoURL
                }));
            }).catch((error) => {
                console.error('Error during Google sign-in: ', error);
            });
        }

    </script>
</body>
</html>