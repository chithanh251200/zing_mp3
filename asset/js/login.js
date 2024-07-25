

// xử lý https -> server login

    const formLogin = document.querySelector('.LG__wapper-login__form');
    // console.log(formLogin);

    formLogin.addEventListener('submit', async function (e) {
        e.preventDefault();
        
        const email = document.getElementById('loginEmail').value;
        console.log(email)
        const password = document.getElementById('loginPassword').value;
        console.log(password)

        fetch('view/login/auth.php',
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
                document.querySelector('.LG__wapper-body__form-head__success').textContent = data.status
                // console.log(data);
            }
                
        })
        .catch(error => console.error('There was a problem with the fetch operation:', error));
    });

    function protected(token){
        fetch('view/login/verifyToken.php',
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
                window.location.replace('view/login/auth2.php');
            }else{
                console.log(dataAccount.status)
            }
        })
        .catch(error => console.error('There was a problem with the fetch operation:', error));
    }














// xử lý ui login

    // xử lý cho 2 trường hợp (1,2)
    const wapperBody = document.querySelectorAll('.LG__wapper-body');
    const formFF = document.querySelectorAll('.LG__wapper-body__formFF');


    // 1 thực hiện hành vi click chuyển đăng ký với đăng nhập
    const groupWapperDIV = document.querySelectorAll('.LG__wapper');
    const linkClick = document.querySelectorAll('.LG__footer-link__click');
    Array.from(linkClick).forEach((element , key) => {
        element.addEventListener('click' , function(){
            // check 
            if(key === 0){
                groupWapperDIV[0].classList.remove('activeLR');
                groupWapperDIV[1].classList.add('activeLR');

                // cho các active form trở về ban đầu
                wapperBody[key].classList.add('activeFF');
                formFF[key].classList.remove('activeFF');

            }else{
                groupWapperDIV[0].classList.add('activeLR');
                groupWapperDIV[1].classList.remove('activeLR');

                // cho các active form trở về ban đầu
                wapperBody[key].classList.add('activeFF');
                formFF[key].classList.remove('activeFF');
            }

        })
    })

    

    // 2 Xử lý click vào đăng nhập đăng ký email và số điện thoại xuất form ra
    const groupBodyListLoginItemSM = document.querySelectorAll('.LG__wapper-body__list-buttonSM');
    //  console.log(groupBodyListLoginItemSM.keys)


    Array.from(groupBodyListLoginItemSM).forEach((element,key) => {
        element.addEventListener('click' , function(){
            // console.log(1 , key);
            if(key === 0){
                // console.log(0);
                wapperBody[key].classList.remove('activeFF');
                formFF[key].classList.add('activeFF'); 
            }else{
                // console.log(1);
                wapperBody[key].classList.remove('activeFF');
                formFF[key].classList.add('activeFF'); 
            }
        });
    });



    // xử lý click thay đổi form sms hoặc email
    const formEmail = document.querySelectorAll('.LG__wapper-body__form-email');
    //  console.log(formEmail);
    const formPhone = document.querySelectorAll('.LG__wapper-body__form-phone');
    //  console.log(formPhone);

    const groupWapperBodyFormHeadText = document.querySelectorAll('.LG__wapper-body__form-head__text');
    //  console.log(groupWapperBodyFormHeadText);

    Array.from(groupWapperBodyFormHeadText).forEach((element , key) => {
        element.addEventListener('click' , function(){
            if(key === 0){
                // console.log(0);
                formEmail[0].classList.remove('activeSE')
                formPhone[0].classList.add('activeSE')

            }else if(key === 1){
                // console.log(1);
                formEmail[0].classList.add('activeSE')
                formPhone[0].classList.remove('activeSE')

            }else if(key === 2){
                // console.log(2);
                formEmail[1].classList.remove('activeSE')
                formPhone[1].classList.add('activeSE')

            }else{
                // console.log(3);
                formEmail[1].classList.add('activeSE')
                formPhone[1].classList.remove('activeSE')
            }
        })
    })

