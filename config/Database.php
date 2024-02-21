<?php

    class Database{

        public $host = 'localhost';
        public $root = 'root';
        public $pass = '';
        public $name = 'zing-mp3';

        public $conn;
        public $error;

        public function __construct(){
            $this->connectDB();
        }

        private function connectDB(){
            $this -> conn = mysqli_connect( $this -> host , $this -> root , $this -> pass , $this -> name);
            if(!$this -> conn){
                $this -> error = "Contected fail" . $this -> conn -> connect_error;
                echo $this -> error;
                return false;
            }else{
                // echo "connected thành công";
            }
        }


        public function select($query){
            $result = $this -> conn -> query($query);
            if($result -> num_rows > 0){
                return $result;
            }else{
                return false;
            }
        }


        public function insert($query){
            $result = $this -> conn -> query($query);
            if($result > 0){
                return $result;
            }else{
                return false;
            }
        }


        public function update($query){
            $result = $this -> conn -> query($query);
            if($result > 0){
                return $result;
            }else{
                return false;
            }
        }


        public function delete($query){
            $result = $this -> conn -> query($query);
            // print($result);
            if($result > 0){
                return $result;
            }else{
                return false;
            }
        }


        // chú ý cực kì quan trọng thường xảy ra lõi :
        // Warning: mysqli_fetch_assoc() expects parameter 1 to be mysqli_result, bool given in C:\xampp\htdocs\chithanh\zing-mp3\config\Database.php on line 41
        // cách sữa 
        


    }
?>