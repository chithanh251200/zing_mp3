
<?php

    require_once '../../lib/dompdf/vendor/autoload.php';

    // reference the Dompdf namespace
    use Dompdf\Dompdf;
    use Dompdf\Options;

    class Pdf{

        private $dompdf;
        private $options;

        public function __construct(){
            $this -> dompdf = new Dompdf(); // Tạo một đối tượng DOMPDF
            // $this -> options = new Options();
        }

        public function showPdf($data){

            $table = '<h1>Danh sách tất cả các nghệ sĩ </h1>';
            $table .='<table style="border: 1px solid black; border-collapse: collapse;">';         
            $table .=     '<tr>';
            $table .=        '<th>Số thứ tự</th>';
            $table .=         '<th>Tên ca sĩ</th>';
            $table .=         '<th>Gới tính</th>';
            $table .=     '</tr>';
            
            $stt = 1;
            foreach($data as $key => $value){
                    $gender = $value['genderSG'] == 'male' ? 'Nam' : 'Nữ' ;
                    $table .=      '<tr style="text-align:center">';
                    $table .=             '<td>'.$stt++.'</td>';
                    $table .=             '<td>'.ucwords($value['nameSG']).'</td>';
                    $table .=             '<td>'.$gender.'</td>';
                    $table .=       '</tr>';
            }
            $table .= '</table>';




            // Load content from html file singerList
            // $sgList = file_get_contents("singerList.php");
            // $dompdf->loadHtml($sgList , 'UTF-8');


            // set các font utf8 trên pdf 
            
            
            // $dompdf->setHttpContext('utf-8');
            $this -> dompdf->loadHtml($table, 'UTF-8');

            
            $this -> dompdf->set_option('defaultFont', 'Inter');
            $this -> dompdf->set_option('fontDir', 'path/to/ttf/fonts');
            $this -> dompdf->set_option('fontCache', 'path/to/font/cache/dir');
            $this -> dompdf->set_option('defaultFont', 'font_name');


            $this -> dompdf->set_option('isPhpEnabled', true); // Khởi động PHP
            $this -> dompdf->set_option('isHtml5ParserEnabled', true); // Bật trình phân tích HTML5
            $this -> dompdf->set_option('debugPng', true); // Chế độ debug cho PNG
            $this -> dompdf->set_option('debugKeepTemp', true); // Giữ các tệp tạm thời khi debug
            $this -> dompdf->set_option('isFontSubsettingEnabled', true); // Bật tạo subset font



            // (Optional) Setup the paper size and orientation
            $this -> dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $this -> dompdf->render();


            // $options = $dompdf->getOptions();
            // $options->setDefaultFont('Courier');
            // $dompdf->setOptions($options);


            // Output the generated PDF to Browser
            // Output the generated PDF (1 = download file pdf or 0 = preview file pdf) 
            ob_end_clean(); // (chú ý nếu không có đoạn code này thì sẽ sinh ra lỗi)

            if(isset($_POST['download_Pdf'])){
                $this -> dompdf->stream('listsinger.pdf', array('Attachment' => 1));
            }
            $this -> dompdf->stream('listsinger.pdf', array('Attachment' => 0));
            exit(0);

        }
    }

?>