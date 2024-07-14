
<?php
    require_once '../classes/Singer.php';
    require_once '../classes/Excel.php';
    require_once '../classes/Pdf.php';
    
    require_once '../../lib/excel/vendor/autoload.php'; // excel 
    
?>
<?php

    if(isset($_POST['show_Pdf']) || isset($_POST['download_Pdf'])){

        $sg = new Singer;
        $data = $sg -> getAll();
        $pdf = new Pdf();
        $pdf -> showPdf($data);
    
        // instantiate and use the dompdf class
       
        // print_r($dompdf);
    
    }


    if(isset($_POST['show_Excel'])){


        $sg = new Singer();
        $all = $sg -> getAll();
        // print_r($all);

        $ex = new ExcelCreator();
        $ex -> addData($all);

        // $ran = rand(0,99).'.xlsx';
        // echo $ran;
        $ex -> saveData('hello.xlsx');


        // $stt = 0;
        // foreach( as $row){
        //     $nameSG = ucwords($row['nameSG']);
        //     $gender = $row['genderSG'] == 'male' ? 'Nam' : 'Nữ';
        // }


        // $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // $activeWorksheet = $spreadsheet->getActiveSheet();
        // $activeWorksheet->setCellValue('A1', 'Hello World !');

        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        // $writer->save('hello world.xlsx');


        // load data 
        // $loadedExcelHandler = new ExcelCreator();
        // $loadedExcelHandler->load($fileName);
        // $loadedData = $loadedExcelHandler->getData();
        

        // print_r($loadedData);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Danh sách ca sĩ</h1>
    <form action="" method="post" accept-charset="utf-8">
        <button name="show_Pdf" class='show-pdf'>Xem PDF</button>
        <button name="show_Excel" class='show_Excel'>Xem Excel</button>

        <table name='table' style="border: 1px solid black; border-collapse: collapse;">
            <tr>
                <th>Số thứ tự</th>
                <th>Tên ca sĩ</th>
                <th>Gới tính</th>
                <th colspan="2">Tác Vụ</th>
            </tr>
            <?php
                $sg = new Singer;
                $stt = 1;
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
    </form>

</body>
</html>