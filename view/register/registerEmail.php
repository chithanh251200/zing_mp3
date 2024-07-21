<?php

    //Load Composer's autoloader
    require '../../vendor/autoload.php';
    require '../../admin/classes/Admin.php';
    require '../../config/config.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
        
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    // lay du lieuj tu form
    $input = file_get_contents('php://input');

    // Giải mã dữ liệu JSON
    $dataClient = json_decode($input, true);

    // name
    $name = $dataClient['name'];
    // tạo biến email
    $email = $dataClient['email'];
    // password
    $password = md5($dataClient['password']);


    // tạo code ngẫu nhiên để xác thực 
    $code = rand(1000 , 9999);


    // // lấy dữ liệu account admin    
    $admin = new Admin();
    $row = $admin -> checkRegisterEmail($email);
    // echo ($row);


    $status = 'error';


    // check data đã tồn tại email đó chưa 
    // == 0 là chưa
    // == 1 đã có
    if(isset($ow) == 0){
        $insert = $admin -> insertRegisterEmail($name , $email , $password); 
        // giá trị nhận về là true = 1
        // echo $insert ;

        if($insert == 1){

            // them thanh cong 
            $status = 'success';


            try {
                //Server settings ( người gửi )
                $mail->SMTPDebug = 0;                      //Enable verbose debug output 1 and 2 (bật lỗi lên để pít nếu có lỗi sinh ra còn biết để sữa)
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'nguyenchithanh2000.nina@gmail.com';                     //SMTP username
                $mail->Password   = 'jsbd ersf ptej ssgn';                               //SMTP password
                $mail->SMTPSecure = 'tls';                                  //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                //Recipients (người nhận)
                $mail->setFrom('nguyenchithanh2000.nina@gmail.com', 'nguyenchithanh2000'); // 
                $mail->addAddress($email , 'ncthanh258');     //Add a recipient Thêm người nhận
                // $mail->addAddress('ncthanh258@gmail.com', 'ncthanh258');     //Add a recipient Thêm người nhận
                // $mail->addReplyTo('nguyenchithanh2000.nina@gmail.com', 'Information ');  //Địa chỉ email để nhận phản hồi lại cho người gửi
                // $mail->addCC('cc@example.com'); // Thêm địa chỉ email nhận bản sao (CC)
                // $mail->addBCC('bcc@example.com'); // // Thêm địa chỉ email nhận bản sao ẩn (BCC)
            
                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Xác thực Email';
                $mail->Body    = 'xin chào '.$email.' rất vui được gặp bạn ! <b>in bold!</b> <a href="http://">Mã code của bạn là : '.$code.'</a>';
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
                // echo 'Message has been sent , chuc mung dang ky thành công';

            } catch (Exception $e) {
                // echo "Message could not be sent thất bại. Mailer Error: {$mail->ErrorInfo}";
            }

        }

    }else{
        echo 'Đăng ký tài khoản không thành công';
    }


    // tạo token code mã xác thực
    $keyJWTcode = JWT_SECRET_EMAIL;

    // Dữ liệu payload (các thông tin cần lưu trong token)
    $payload = array(
        "iss" => JWT_ISSUER_EMAIL,
        "aud" => JWT_AUDIENCE_EMAIL,
        "iat" => time(),
        "nbf" => time(),
        "expr" => JWT_EXPIRATION_EMAIL,
        "dataCodeMail" => [
            "email" => $email,
            "code" => $code
        ]
    );

    // Tạo token JWT
    $jwt = JWT::encode($payload, $keyJWTcode , 'HS256');


    if($status === 'success'){
        echo json_encode([
            'status' => $status,
            'token' => $jwt
        ]);
    }else{
        echo json_encode(['status' => $status]);
    }

?>