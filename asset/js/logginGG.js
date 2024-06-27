
// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-analytics.js";

// Add Firebase products that you want to use
import { getAuth ,signInWithPopup , GoogleAuthProvider , FacebookAuthProvider } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js";
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
const google = new GoogleAuthProvider();
const facebook = new FacebookAuthProvider();


const googleLogin = document.getElementById('googleSignInButton');
googleLogin.addEventListener('click', function(){
    //    alert(5);
    signInWithPopup(auth, google)
            .then((result) => {
                const credential = GoogleAuthProvider.credentialFromResult(result);
                const user = result.user;
                console.log(user);
                // window.location.href = '';
            })
            .catch((error) => {
                const errorCode = error.code;
                const errorMessage = error.message;
            });
});

const facebookLogin = document.getElementById('facebookSignInButton');
facebookLogin.addEventListener('click', function(){
    signInWithPopup(auth, facebook)
        .then((result) => {
            // This gives you a Facebook Access Token. You can use it to access the Facebook API.
            const credential = FacebookAuthProvider.credentialFromResult(result);
            const token = credential.accessToken;
        
            const user = result.user;
            // IdP data available using getAdditionalUserInfo(result)
            // ...
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
    });