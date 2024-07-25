// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-analytics.js";

// Add Firebase products that you want to use
import { getAuth , onAuthStateChanged  } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js";
import { getFirestore } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-firestore.js";

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



//check user hiên tại có đang đăng nhập không
onAuthStateChanged(auth, (user) => {
  if (user) {

    // User is signed in, see docs for a list of available properties
    // https://firebase.google.com/docs/reference/js/auth.user

    // lấy tất cả thông tin người dùng 
    const displayName = user.displayName; // tên người dùng
    const email = user.email; // email
    const photoURL = user.photoURL; // ảnh facebook nếu thông tin này có 
    const emailVerified = user.emailVerified; 
    const phoneNumber = user.phoneNumber; // số điện thoại nếu người dùng login bằng SMS
    const uid = user.uid;


    console.log(user);
    console.log(uid);


    // tồn tại người dùng đăng nhập
    if(uid){
        console.log('tồn tại người dùng');
    }else{
        console.log('không tồn tại user');
    }


    // ...
  } else {
    // User is signed out
    // ...
  }
});