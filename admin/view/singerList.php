
<?php
    include_once '../classes/Singer.php';
?>

<?php
    include_once '../inc/headerAdmin.php';
?>
    <h1>Danh sách ca sĩ</h1>
    <table style="border: 1px solid black; border-collapse: collapse;">
        <tr>
            <th>Số thứ tự</th>
            <th>Tên ca sĩ</th>
            <th>Gới tính</th>
            <th colspan="2">Tác Vụ</th>
        </tr>
        <?php
            $sg = new Singer;
            $stt = 0;
            foreach($sg -> getAll() as $row){
        ?>
            <tr style="text-align:center">
                <td><?php echo $stt++ ?></td>
                <td><?php echo ucwords($row['nameSG']) ?></td>
                <td><?php echo $row['genderSG'] == 'male' ? 'Nam' : 'Nữ' ?></td>
                <td><a href="singerAdd">Thêm</a></td>
                <td><a href="singerDelete?id_SG=<?php  echo $row['id_singer'] ?>">xóa</a></td>
                <td><a href="singerUpdate?id_SG=<?php  echo $row['id_singer'] ?>">cập nhật</a></td>
            </tr>
        <?php
            }
        ?>
        
    
    </table>
</body>
</html>