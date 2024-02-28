<?php
    require_once '../classes/Singer.php';


    if(isset($_GET['id_SG'])){
        $idSG = $_GET['id_SG'];
        // echo $idSG;

        $sg = new Singer();
        $ischeck = $sg -> delete($idSG);

        if($ischeck == true){
            header('Location:singerList');
        }


    }

?>