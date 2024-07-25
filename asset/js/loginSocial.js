

// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-analytics.js";

// Add Firebase products that you want to use
import { getAuth ,
    signInWithPopup ,   
    GoogleAuthProvider , 
    FacebookAuthProvider, 
    RecaptchaVerifier , 
    signInWithPhoneNumber ,
    // kiểm tra user có đang đăng nhập không
    onAuthStateChanged,
    // đăng xuất
    signOut
} from "https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js";

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






//---------- login google ----------//
const google = new GoogleAuthProvider();
const googleLogin = document.querySelectorAll('#googleSignInButton');
// console.log(googleLogin);

if(googleLogin){
    Array.from(googleLogin).forEach(element => {
        element.addEventListener('click' , function(){
    
            // alert(5);
            signInWithPopup(auth, google)
            .then((result) => {
                const credential = GoogleAuthProvider.credentialFromResult(result);
                const user = result.user;
                const token = user.uid;
                // console.log(user);
    
                window.location.href = 'http://localhost:88/chithanh/zing-mp3';
            })
            .catch((error) => {
                const errorCode = error.code;
                const errorMessage = error.message;
            });
        })
    });
}




//---------- login facebook---------//
const facebook = new FacebookAuthProvider();
const facebookLogin = document.querySelectorAll('#facebookSignInButton');
// console.log(facebookLogin);

if(facebookLogin){

    Array.from(facebookLogin).forEach(element => {
        element.addEventListener('click' , function(){
            // console.log(1);

            signInWithPopup(auth, facebook)
            .then((result) => {
                // This gives you a Facebook Access Token. You can use it to access the Facebook API.
                const credential = FacebookAuthProvider.credentialFromResult(result);
                const token = credential.accessToken;
                const user = result.user;
                // IdP data available using getAdditionalUserInfo(result)
                window.location.href = 'http://localhost:88/chithanh/zing-mp3';
    
            }).catch((error) => {
                // Handle Errors here.
                const errorCode = error.code;
                const errorMessage = error.message;
                // The email of the user's account used.
                const email = error.customData.email;
                // AuthCredential type that was used.
                const credential = FacebookAuthProvider.credentialFromError(error);
                // ...
            });


        })
    });

}






//-------- login phone----------//
// reCAPTCHA 
window.recaptchaVerifier = new RecaptchaVerifier(auth, 'sendSMS', {
    'size': 'invisible',
    'callback': (response) => {
        console.log('reCAPTCHA solved');
        onSignInSubmit();
    },
});

// ------------- chú ý cực kì quan trọng :  ---------//
// khi sử dụng fribe login bằng SMS thì không nên để các nút thực thi nằm trong form sẽ không thực thi được sinh ra lỗi
const buttonSendPhone = document.getElementById('sendSMS');
// console.log(buttonSendPhone);

if(buttonSendPhone){
    buttonSendPhone.addEventListener('click', function(e){
        // Ngăn chặn hành vi mặc định của nút button vi nam trong form
        e.preventDefault();

        const phoneNumber = "+84868337741";
        // const phoneNumber = document.getElementById('phoneSMS').value;
        console.log(phoneNumber)

        const appVerifier = window.recaptchaVerifier;
        
    
        if(phoneNumber){
            signInWithPhoneNumber(auth, phoneNumber, appVerifier)
            .then((confirmationResult) => {
                // SMS sent. Prompt user to type the code from the message, then sign the
                // user in with confirmationResult.confirm(code).
                window.confirmationResult = confirmationResult;
                console.log('send')
            })
            .catch((error) => {
                // Error; SMS not sent
                console.log('no');
            });
        }
        else{
            console.log('không tồn tại số điện thoại');
        }


    });
}




// const phoneSubmitSmsCode = document.getElementById('btnVerifyLoginSMS');
// phoneSubmitSmsCode.addEventListener('click', function(){
//     const codeSMS = document.getElementById('codeVerifyLoginSMS').value;
//     const name = document.querySelector('.root__wapper-body__form-nameSMS').value
//     console.log(codeSMS)

//     confirmationResult.confirm(codeSMS).then((result) => {
//         // User signed in successfully.
//         const user = result.user;
//         // Add user information to Firestore
//         return db.collection('users').doc(user.uid).set({
//             uid: user.uid,
//             phoneNumber: user.phoneNumber,
//             name: name,
//             createdAt: firebase.firestore.FieldValue.serverTimestamp()
//         });
//         // window.location.href = 'http://localhost:88/chithanh/zing-mp3/';
//     }).catch((error) => {
//         // User couldn't sign in (bad verification code?)
//         console.log(error);
//     });
// });











    