



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
    fetch('login/protected.php',
    {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token,
        },
    })      
    .then(response => response.json())
    .then(dataAccount => {

        // // kiểm tra account nếu là admin thì chuyển hướng đến trang quan lý
        // if(dataAccount.status === 'success' && dataAccount.data.dataUser.role === 'admin'){
        //     window.location.replace('../admin/view/dashboar.php');
        //     console.log('trang quan lý');
        // }else{
        //     window.location.replace('../index.html');
        //     console.log('trang người dùng');
        // }
        console.log(dataAccount.status)
    })
    .catch(error => console.error('There was a problem with the fetch operation:', error));
}