<?php

    require_once '../../config/Database.php';

    class Songs{

        public $nameS;


        public function __construct(){
            $this -> db = new Database();
        }

        public function getAll(){
            $query = "SELECT * FROM `tb_songList`";
            $result = $this -> db -> select($query);
            $rows = $result -> fetch_all(MYSQLI_ASSOC);
            if($rows != false){
                return $rows;
            }
        }

        public function add($data , $dir){
            print_r($data);
            $query = "INSERT INTO `tb_songlist`(`id_song`, `nameS`, `imageS`, `id_singer`) 
                      VALUES (null , '$nameS' , '$dir' , '4')";
            $result = $this -> db -> insert($query);
            if($result != false){
                echo 'thêm bài hát thành công';
                return true;
            }
        }



    }

?>