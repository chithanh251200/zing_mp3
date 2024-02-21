<?php

    include_once '../../config/Database.php';


    class Singer{
        // use DB as Csdl;

        // public $nameSG;
        // public $genderSG;
        private $db;

        public function __construct(){
            $this -> db = new Database();
        }

        // public function getId(){

        // }

        public function getAll(){
            $query = "SELECT * FROM `tb_singerList`";
            $result = $this -> db -> select($query);
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if($rows != false){
                // var_dump($rows);
                return $rows;
            }
        }

        public function getID($id){
            $query = "SELECT `nameSG`, `genderSG` FROM `tb_singerlist` WHERE `id_singer` = '$id'";
            $result = $this -> db -> select($query);
            $rows = $result -> fetch_assoc();
            if($rows != false){
                // var_dump($rows);
                return $rows;
            }

        }

        public function add($data){
            if(!empty($data)){
                $name = mysqli_real_escape_string($this->db->conn ,$data['name']);
                $gender = mysqli_real_escape_string($this->db->conn ,$data['gender']);
                echo $name , $gender;
                if(!empty($name) && !empty($gender)){
                    $query = "INSERT INTO `tb_singerlist` (`id_singer` , `nameSG`, `genderSG`) VALUES ( null , '$name' , '$gender')";
                    $result = $this -> db -> insert($query);
                    if($result != false){
                        // echo "thêm thành công";
                        return true;
                    }
                }
            }
        }
        public function update($id ,$name , $gender){
            // if(!empty($name) && !empty($gender)){
                $query = "UPDATE `tb_singerlist` SET `nameSG`='$name',`genderSG`='$gender' WHERE `id_singer` = $id";
                $result = $this -> db -> update($query);
                if($result != false){
                    echo "update thành công";
                    echo $id , $name , $gender;
                    return true;
                }
            // }

        }

        public function delete($id) {
            $query = "DELETE FROM `tb_singerlist` WHERE id_singer = $id";
            $result = $this -> db -> delete($query);
            if($result == true){
                return true;
            } 
        }


    }

?>