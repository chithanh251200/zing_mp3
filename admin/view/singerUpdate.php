
<?php

    include_once '../classes/Singer.php';


            $id = $_GET['id_SG'];
            // echo $id;

            $sg = new Singer();
            $getSingerId = $sg -> getId($id);
            // print_r($getSingerId);
        


        // xử lý nút cập nhật
        if(isset($_POST['btn_update'])){

            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $sg -> update($id , $name , $gender);

            echo "<script> windown.location = 'singerList.php'</script>";
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Thêm </title>
</head>
<body>
    <h1>Cập nhật ca sĩ</h1>
    <form action="" method="POST">
        <label for="name">Tên ca sĩ</label>
        <input type="text" value="<?php echo $getSingerId['nameSG'] ?>" name="name">
        <label for="name">Giới tính</label>
        <input type="radio" name="gender" value="male" <?php echo $getSingerId['genderSG'] == 'male' ? 'checked' : ''?>> Nam
        <input type="radio" name="gender" value="female" <?php echo $getSingerId['genderSG'] == 'female' ? 'checked' : ''?>> Nữ
        <input type="submit" name="btn_update" value="Cập nhật">
    </form>
</body>
</html>