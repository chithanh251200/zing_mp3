// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";

// Add Firebase products that you want to use
import { getAuth , signOut } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js";

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
const auth = getAuth(firebaseApp);

const logoutUser = document.getElementById('logoutUser');
logoutUser.addEventListener('click', function(){

    const contentInforUser = document.getElementById('content_inforUser');
    contentInforUser.style.display = 'none';

    const LoginUI = document.getElementById('loginUser');
    LoginUI.style.display = 'block';

    signOut(auth).then(() => {
    // Sign-out successful.
        console.log('đăng xuất thành công');
    }).catch((error) => {
    // An error happened.
        console.log('không đăng xuất được');
    });
});