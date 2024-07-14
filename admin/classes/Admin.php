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
                    echo "Vui lòng đăng nhập lại !";
                }
                
            }
        }

        public function registerGG($data){
            if(!empty($data)){
                echo "tồn tại dữ liệu";
            }
        }


    }


?>

