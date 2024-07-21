
document.getElementById('sendButtonRegisterSMS').addEventListener('click', async function (e) {
    e.preventDefault();

    const name = document.getElementById('registerName').value;
    // console.log(name)
    const email = document.getElementById('registerEmail').value;
    // console.log(email)
    const password = document.getElementById('registerPassword').value;
    // console.log(password)

    fetch('register/registerEmail.php',
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                
            },
            body: JSON.stringify({name , email , password})
        })      
        .then(response => response.json())
        // lấy token jwt từ server
        .then(data => {
            if(data.status === 'success'){
                verifyCodeEmail(data.token)
                console.log('register success');
            }else{
                console.log('register khong thanh cong');
            }
        })
        .catch(error => console.error('There was a problem with the fetch operation:', error));

})


function verifyCodeEmail(token) {
    fetch('register/verifyCodeEmail.php',
        {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            },
        })      
        .then(response => response.json())
        .then(dataVerify => {
    
            // kiểm tra trạng thái thành công thì lấy code từ form so sánh với code gửi trong email xác thực tài khoản đăng ký
            if(dataVerify.status === 'success'){
                document.querySelector('.root__wapper-register___form').addEventListener('submit' , async function(e){
                    e.preventDefault();

                    const codeRegisterEmail = document.querySelector('.root__wapper-register___form-codeEmail').value;
                    // console.log(typeof(codeRegisterEmail) , typeof(dataVerify.data.dataCodeMail.code));

                    if(dataVerify.data.dataCodeMail.code == codeRegisterEmail){
                        console.log('xac thuc dang ki tai khoan thanh cong');
                    }else{
                        console.log('xac thuc tai khoan khong thanh cong');
                    }
            
                })
            }

        })
        .catch(error => console.error('There was a problem with the fetch operation:', error));
}






