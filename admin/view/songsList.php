<?php

    require_once '../classes/Songs.php';

    $s = new Songs();
    $rows = $s -> getAll();
    print_r($rows);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Danh sách bài hát</h1>
    <table style="border: 1px solid black; border-collapse: collapse;">
        <tr>
            <th>Số thứ tự</th>
            <th>Tên bài hát</th>
            <th>Hình ảnh</th>
            <th colspan="2">Tác Vụ</th>
        </tr>
        <?php
            
            $stt = 0;
            foreach($rows as $row){
        ?>
            <tr style="text-align:center">
                <td><?php echo $stt++ ?></td>
                <td><?php echo $row['nameS']?></td>
                <td>
                    <img src="<?php echo $row['imageS'] ?>" alt="" style="width:80px ; height=80px">
                </td>
                <td><a href="songsAdd.php">Thêm</a></td>
                <td><a href="singerDelete.php">xóa</a></td>
                <td><a href="singerUpdate.php">cập nhật</a></td>
            </tr>
        <?php
            }
        ?>
        
    
    </table>
</body>
</html>