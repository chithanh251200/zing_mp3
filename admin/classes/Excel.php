<?php
    require_once '../../lib/excel/vendor/autoload.php'; // excel 

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;


    class ExcelCreator {
        private $spreadsheet;

        public function __construct() {
            $this->spreadsheet = new Spreadsheet();
        }

        public function addData($data) {
            $this -> spreadsheet ->setActiveSheetIndex(0);
            $sheet = $this->spreadsheet->getActiveSheet();
            if(isset($data)){
                $row = 1;
                foreach ($data as $key => $value) {
                    $col = 1;
                    foreach($value as $k => $v){
                        $sheet->setCellValueByColumnAndRow($col, $row, $v);
                        $col++;
                    }
                    $row++;
                }
            }
        }

        public function saveData($filename) {
            $writer = new Xlsx($this -> spreadsheet);
            $writer->setOffice2003Compatibility(true);
            $writer->save($filename);
            echo "Excel file has been created successfully!";
        }

        // public function load($filename) {
        //     $this->spreadsheet = IOFactory::load($filename);
        // }

        // public function getData() {
        //     $sheet = $this->spreadsheet->getActiveSheet();
        //     $data = [];
        //     foreach ($sheet->getRowIterator() as $row) {
        //         $rowData = [];
        //         $cellIterator = $row->getCellIterator();
        //         $cellIterator->setIterateOnlyExistingCells(false);
        //         foreach ($cellIterator as $cell) {
        //             $rowData[] = $cell->getValue();
        //         }
        //         $data[] = $rowData;
        //     }
        //     return $data;
        // }
    }

?>
