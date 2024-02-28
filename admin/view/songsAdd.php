
<?php

    require_once '../classes/Songs.php';

        if(isset($_POST['btn_add'])){

            if(isset($_FILES['image'])){
                $file_name = $_FILES['image']['name'];
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

                $dir = '../asset/img/'.$file_name;
                if (move_uploaded_file($file_tmp, $dir)) {
                    echo "File successfully uploaded.\n";
                } else {
                    echo "thất bại!\n";
                }

                $s = new Songs();
                // $_POST chuyển tất cả dữ liệu nhập từ form qua kia
                $s -> add($_POST , $dir);
                
                // header('Location:http://localhost/chithanh/zing-mp3/admin/view/songsList.php');
            }
            
            


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
    <h1>thêm bài hát</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Tên bài hát</label>
        <input type="text" value="" name="name">

        <label for="image">Hình ảnh</label>
        <input type="file" name="image" id="file">

        <label for="image">Nghê sĩ</label>
        <select name="select" id="select">
            <option value="">--Chọn Nghệ sĩ--</option>
            <option value="">Thành đạt</option>
        </select>

        <input type="submit" name="btn_add" value="Thêm">
    </form>
</body>
</html>