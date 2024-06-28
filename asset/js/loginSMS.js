// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-analytics.js";

// Add Firebase products that you want to use
import { getAuth , RecaptchaVerifier , signInWithPhoneNumber } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js";
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


 // reCAPTCHA 
 window.recaptchaVerifier = new RecaptchaVerifier(auth, 'sendSMS', {
  'size': 'invisible',
  'callback': (response) => {
    // reCAPTCHA solved, allow signInWithPhoneNumber.
    onSignInSubmit();
  }
});






// ------------- chú ý cực kì quan trọng : không đặt được thể xác thực sendMSM trong form sẽ không thực thi được ---------//
const buttonSendSMS = document.getElementById('sendSMS');
buttonSendSMS.addEventListener('click', function(){
    const phoneNumber = "+84868337741";
    // const phoneNumber = document.getElementById('phone').value;
    // console.log(phoneNumber)
    const appVerifier = window.recaptchaVerifier;

    if(phoneNumber){
        signInWithPhoneNumber(auth, phoneNumber, appVerifier)
        .then((confirmationResult) => {
          // SMS sent. Prompt user to type the code from the message, then sign the
          // user in with confirmationResult.confirm(code).
          window.confirmationResult = confirmationResult;
          console.log('send')
          // return confirmationResult;
          // window.location.href = 'view/verificationCodeSMS.php';
        })
        .catch((error) => {
          // Error; SMS not sent
          console.log('no')
          // // gửi lại mã nếu lỗi không gửi được
          // window.recaptchaVerifier.render().then(function(widgetId) {
          //   grecaptcha.reset(widgetId);
          // });
        });
    }
    else{
      console.log('không tồn tại số điện thoại');
    }
});






const loginBtnSMS = document.getElementById('loginSMS');
loginBtnSMS.addEventListener('click', function(){
    const codeSMS = document.getElementById('codeSMS').value;
    console.log(codeSMS)

    confirmationResult.confirm(codeSMS).then((result) => {
    // User signed in successfully.
    const user = result.user;
    console.log(user);
    window.location.href = 'http://localhost:88/chithanh/zing-mp3/';
    // ...
    }).catch((error) => {
    // User couldn't sign in (bad verification code?)
    // ...
    console.log(error);
    });
});






