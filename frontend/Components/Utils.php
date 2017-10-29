<?php
namespace app\components;

class Writer
{
    public static function readCSV($csvFile)
    {
        $file_handle = fopen($csvFile, 'r');
        $arrCSVData = array();
        while (!feof($file_handle)) {
            $arrCSVData [] = fgetcsv($file_handle, 1024, ",");
        }
        fclose($file_handle);
        return $arrCSVData;
    }
}