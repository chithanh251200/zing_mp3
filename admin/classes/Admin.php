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

        public function checkAdmin($user , $pass){
            if(isset($user) && isset($pass)){
                $query = "SELECT * FROM  admin WHERE name = '$user' AND password = '$pass' LIMIT 1 ";
                $result = $this -> db -> select($query);
                if($result != false){
                    $value = $result -> fetch_assoc();
                    // print_r( $value);
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

