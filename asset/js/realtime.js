// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getDatabase , ref , set , runTransaction , onValue , update } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

// Add Firebase products that you want to use
import { getAuth , onAuthStateChanged  } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js";

const firebaseConfig = {
        apiKey: "AIzaSyABrdRvmExHlsjAaXj8v2lUBqojmWg8_GI",
        authDomain: "zing-mp3-d2229.firebaseapp.com",
        projectId: "zing-mp3-d2229",
        storageBucket: "zing-mp3-d2229.appspot.com",
        messagingSenderId: "734057184662",
        appId: "1:734057184662:web:b993bb92617409b31931b7",
        measurementId: "G-EPBHRQGEDD",
        databaseURL: "https://zing-mp3-d2229-default-rtdb.firebaseio.com/"
    };

// Initialize Firebase
const firebaseApp = initializeApp(firebaseConfig);
const auth = getAuth(firebaseApp);


const database = getDatabase(firebaseApp);
// console.log(database);


// tạo đường dẫn
const songRef = ref(database, 'songs/' +'idSong=3/'+ 'info');

// sét giá trị vào ref
// const setData = set(songRef , {
//   nameSinger : 'hồ quang hiếu',
//   nameSong : 'Cô Phòng',
//   view : '5',
//   like : '30',
//   love : '12000'
// });


// lấy dữ liệu từ trên realtime database
onValue(songRef, (snapshot) => {
  const loveTotal = document.getElementById('total-love');
  const data = snapshot.val();

  // xuất dữ liêu lên dom 
  loveTotal.innerText = data.love;
  // updateStarCount(postElement, data);
});




const audioPlayer = document.getElementById('audioPlayer');




audioPlayer.addEventListener('play' , function(){
});


// các bước quan trọng thực hiện tính lượt view audio 
// 1. tạo mảng để push thời gian chạy (currentime) vào mảng , kiểm tra nếu tồn tại thì không push vào
// 2 . kiểm tra mảng có tổng số giây nếu = 50 thì sẽ thêm 1 view vào đatabase
// 3 . kiểm tra reset nếu điều kiện đúng thì chỉ xử lý 1 lần duy nhất
// 4 . khởi tạo lại từ đầu , đặt lại biến a , và biến reset khi thời gian chạy ( ended ) kết thúc
let a = [];
let reset = false;
audioPlayer.addEventListener('timeupdate', () => {

  const currentTime = Math.floor(audioPlayer.currentTime);
  // console.log(currentTime);
  const duration = Math.floor(audioPlayer.duration);
  // const totalPercent = ((currentTime / duration) * 100);
  // const minutes = Math.floor(duration / 60);
  // const secs = Math.floor(currentTime % 60);

  // check mảng nếu tồn tại currentime (gi) rồi thì không thêm vào mảng nữa
  if(a.indexOf(currentTime) === -1){
    a.push(currentTime)
    //  console.log('push vào' , a);
  }
  // console.log(a);

  // tính tổng phần trăm bài hát
  let totalPercent = ((a.length / 10) *100) .toFixed(0);
  // console.log(typeof(totalPercent));

  // kiểm tra 1 lần duy nhất đối với curreentime vì nó chạy nhìu lần  => đặt Một biến cờ (!flag) có thể được sử dụng để đảm bảo rằng một điều kiện chỉ được kiểm tra và thực thi một lần duy nhất.
  // kiểm tra tổng thời gian bài hát nếu = 50% thì reset lại không cho cộng 1 view nào data nữa 
  // giải thích nếu để > 50 thì cứ mõi lần % lớn hơn 50 thì cứ típ tục cộng thêm view nữa , lỗi logic
  // chú ý cực quan trọng nếu so sánh = 50% thì tăng 1 view , tính tổng phần trăm ở trên để ở dạng string nên phải dùng == , nếu muốn dùng === thì phải chuyển sang dạng số
  if(totalPercent == 50){
    if(!reset){
      reset = true;
      // console.log('+1');
      let view = 0;
      onValue(songRef, (snapshot) => {
          let data =  snapshot.val();
          view = data.view
      });
      const updates = {
        'view': Number(view) + 1,
      }
      update(songRef, updates)
    }else{
      console.log('Điều kiện đã được kiểm tra trước đó. View đã được cộng vào data rồi');
    }
    
  }else{
    console.log('không' , totalPercent);
  }

})



audioPlayer.addEventListener('pause' , function(){
});



audioPlayer.addEventListener('ended',function(){
  a = [];
  reset = false
  // console.log(reset);
});


const buttonLove = document.getElementById('love');
buttonLove.addEventListener('click' , function(){

  const check = this.getAttribute('check');
  if(check === ''){
    this.setAttribute('check', 'checked');
    this.style.background = 'red'
    // lấy dữ liệu từ database realtime
    let dataLove = 0;
    onValue(songRef, (snapshot) => {
        let data =  snapshot.val();
        dataLove = data.love
    });
    const updates = {
      'love': Number(dataLove) + 1,
    }
    update(songRef, updates)
    console.log(dataLove);
    
  }else{
    this.setAttribute('check', '');
    this.style.background = ''
    let dataLove = 0;
    onValue(songRef, (snapshot) => {
        let data =  snapshot.val();
        dataLove = data.love
    });
    const updates = {
      'love': Number(dataLove) -1,
    }
    update(songRef, updates)
    console.log(dataLove);
  }

}); 






