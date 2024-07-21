


const formLogin = document.querySelector('.root__wapper-login__form');
// console.log(formLogin);

formLogin.addEventListener('submit', async function (e) {
    e.preventDefault();
    
    const email = document.getElementById('loginEmail').value;
    console.log(email)
    const password = document.getElementById('loginPassword').value;
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
    .then(data => {
        if(data.status === 'success') {
            protected(data.token)
            // console.log(data)
        }else{
            document.querySelector('.root__wapper-body__form-head__success').textContent = data.status
            // console.log(data);
        }
            
    })
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

        console.log(dataAccount);

        // kiểm tra trạng thái thành công thì chuyển đến trang xác thực cấp 2 báng SMS OTP 
        if(dataAccount.status === 'success'){
            window.location.replace('login/auth2.php');
        }else{
            console.log(dataAccount.status)
        }
    })
    .catch(error => console.error('There was a problem with the fetch operation:', error));
}