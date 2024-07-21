<?php 
    include $_SERVER["DOCUMENT_ROOT"].'/chithanh/zing-mp3/config/Database.php';
    // echo "<pre>";
    // print_r($_SERVER);
    // echo "</pre>";

    class Admin{
        // use DB\Database;

        private $db;

        public function __construct(){
            $this -> db = new Database();
        }

        public function checkAdmin($email , $pass){
            if(isset($email) && isset($pass)){
                $query = "SELECT * FROM  admin WHERE `email` = '$email' AND `password` = '$pass' LIMIT 1 ";
                // echo $query;
                $result = $this -> db -> select($query);
                // echo $result;
                if($result != false){
                    $value = $result -> fetch_assoc();
                    // print_r( $value);
                    // echo "đăng nhâp thành công";
                    return $value;
                }
                else{
                    // echo "Tài khoản không hợp lệ ! Vui lòng kiểm tra lại email hoặc mật khẩu";
                }
                
            }
        }

        public function checkRegisterEmail($email){
            if(isset($email)){
                $query = "SELECT email FROM  admin WHERE `email` = '$email' LIMIT 1";
                $result = $this -> db -> select($query);
                // Kiểm tra nếu không có kết quả truy vấn trả về thì không tồn tại email trong hệ thống thì return 0 về để thêm account vào
                if ($result === false) {
                    return 0;
                }
            }else{
                echo 'không tồn tại dữ liệu';
            }
        }


        public function insertRegisterEmail($name , $email , $password){
            if(isset($email) && isset($password)){
                $query = "INSERT INTO `admin` (`id_admin`, `name`, `email`, `password`, `role`) 
                          VALUES (null ,'$name' ,'$email', '$password', 'user')";
                $result = $this -> db -> insert($query);

                if($result != false){
                    return true;
                    // echo 'thêm thành công';
                }else{
                    return false;
                    // echo 'thêm không thành công';
                }

            }
        }


    }
?>

