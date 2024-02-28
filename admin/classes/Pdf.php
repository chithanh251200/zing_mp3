
<?php

    require_once '../../lib/dompdf/vendor/autoload.php';

    class Pdf{

        // reference the Dompdf namespace
        use Dompdf\Dompdf;
        use Dompdf\Options;

        private $dompdf;
        private $options;

        private function __construct(){
            $this -> dompdf = new Dompdf(); // Tạo một đối tượng DOMPDF
            $this -> options = new Options();
        }

        public function showPdf($data){

            


            $table = '<h1>Danh sách nghệ sĩ cùng chung thông tin </h1>';
            $table .='<table style="border: 1px solid black; border-collapse: collapse;">';         
            $table .=     '<tr>';
            $table .=        '<th>Số thứ tự</th>';
            $table .=         '<th>Tên ca sĩ</th>';
            $table .=         '<th>Gới tính</th>';
            $table .=        '<th colspan="2">Tác Vụ</th>';
            $table .=     '</tr>';
            
           
            foreach($data as $key => $value){
                print_r($value);
                // $table .=      '<tr style="text-align:center">';
                // $table .=             '<td>0</td>';
                // $table .=             '<td>'.$value.'</td>';
                // $table .=             '<td>'.$value.'</td>';
                // $table .=       '</tr>';
            }
            $table .= '</table>';




            // Load content from html file singerList
            // $sgList = file_get_contents("singerList.php");
            // $dompdf->loadHtml($sgList , 'UTF-8');


            // set các font utf8 trên pdf 
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->set_option('isPhpEnabled', true);
            $dompdf->set_option('defaultFont', 'Arial');
            $dompdf->set_option('isRemoteEnabled', true);
            $dompdf->set_option('isHtml5ParserEnabled', true);


            // $dompdf->setHttpContext('utf-8');
            $dompdf->loadHtml($data, 'UTF-8');

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();


            // $options = $dompdf->getOptions();
            // $options->setDefaultFont('Courier');
            // $dompdf->setOptions($options);


            // Output the generated PDF to Browser
            // Output the generated PDF (1 = download and 0 = preview) 
            ob_end_clean(); //(chú ý nếu không có đoạn code này thì sẽ sinh ra lỗi)

            if(isset($_POST['download_Pdf'])){
                $dompdf->stream('listsinger.pdf', array('Attachment' => 1));
            }
            $dompdf->stream('listsinger.pdf', array('Attachment' => 0));

            // $dompdf -> stream();
            exit(0);

        }
    }

?>