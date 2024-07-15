



document.getElementById('loginForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    
    const email = document.getElementById('email').value;
    console.log(email)
    const password = document.getElementById('password').value;
    console.log(password)

    fetch('login/auth.php',
    {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            
        },
        body: JSON.stringify({email , password})
    })      
    .then(response => response.json())
    // lấy token jwt từ server
    .then(token => 
        protected(token)
        // console.log(token)
    )
    .catch(error => console.error('There was a problem with the fetch operation:', error));
});

function protected(token){
    fetch('login/verifyToken.php',
    {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token,
        },
    })      
    .then(response => response.json())
    .then(dataAccount => {

        // kiểm tra trạng thái thành công thì chuyển đến trang xác thực cấp 2 báng SMS OTP 
        if(dataAccount.status === 'success'){
            window.location.replace('login/auth2.php');
        }
        // console.log(dataAccount.status , dataAccount.data.dataUser.role)
    })
    .catch(error => console.error('There was a problem with the fetch operation:', error));
}