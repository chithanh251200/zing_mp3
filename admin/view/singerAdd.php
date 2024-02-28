
<?php

    require_once '../classes/Singer.php';

        if(isset($_POST['btn_add'])){

            $sg = new Singer();
            $sg -> add($_POST);
            header('Location:singerList');

        }
?>


<?php
    require_once '../inc/headerAdmin.php';
?>

    <h1>thêm ca sĩ</h1>
    <form action="singerAdd" method="POST">
        <label for="name">Tên ca sĩ</label>
        <input type="text" value="" name="name">
        <label for="name">Giới tính</label>
        <input type="radio" name="gender" value="male"> Nam
        <input type="radio" name="gender" value="female"> Nữ
        <input type="submit" name="btn_add" value="Thêm">
    </form>
</body>
</html>