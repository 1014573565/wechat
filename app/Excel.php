<?php

namespace App;

use DB;


class Excel
{
    public static function importExcel($inputFileName){
        $inputFileType = 'Xlsx';
        //    $inputFileType = 'Xlsx';
        //    $inputFileType = 'Xml';
        //    $inputFileType = 'Ods';
        //    $inputFileType = 'Slk';
        //    $inputFileType = 'Gnumeric';
        //    $inputFileType = 'Csv';

        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();

        $html = '';
        $html .= '<table class="table table-responsive-md table-hover mb-0"><tbody>' . PHP_EOL;
        foreach ($worksheet->getRowIterator() as $row) {
            $html .= '<tr>' . PHP_EOL;
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            //    even if a cell value is not set.
            // By default, only cells that have a value
            //    set will be iterated.
            foreach ($cellIterator as $cell) {
                if($cell->getValue() != ''){
                    $html .= '<td>' .
                        $cell->getValue() .
                        '</td>' . PHP_EOL;
                }
            }
            $html .= '</tr>' . PHP_EOL;
        }
        $html .= '</tbody></table>' . PHP_EOL;
        return $html;
    }

    public static function removeExcel($file_name){
        @unlink($file_name);
    }


    public static function insertExcel($inputFileName){
        $inputFileType = 'Xlsx';
        //    $inputFileType = 'Xlsx';
        //    $inputFileType = 'Xml';
        //    $inputFileType = 'Ods';
        //    $inputFileType = 'Slk';
        //    $inputFileType = 'Gnumeric';
        //    $inputFileType = 'Csv';

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();

        return $worksheet;
    }

    public static function getUploadPath($file_name){
        $path = config('filesystems.disks.local.root');
        return $path.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$file_name;
    }

}














