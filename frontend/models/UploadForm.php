<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 15.11.2016
 * Time: 21:55
 */
namespace app\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 * UploadForm
 * 
 * @author Alex Hunt
 * @copyright partcom
 * @version 2017
 * @access public
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;
    public $save_format;
    public $delete_content;


    /**
     * UploadForm::rules()
     * 
     * @return
     */
    public function rules()
    {
        return [[['file'], 'file', 'skipOnEmpty' => true, 'extensions' =>
            'xls, xlsx,csv,txt'], ];
    }
    /**
     * UploadForm::upload()
     * 
     * @return
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->
                extension);
            return true;
        } else {
            return false;
        }
    }
    /**
     * UploadForm::attributeLabels()
     * 
     * @return
     */
    public function attributeLabels()
    {
        return ['file' => 'Файл', 'save_format' => 'Сохранить формат', ];
    }

    /**
     * UploadForm::getPath()
     * 
     * @return
     */
    public function getPath()
    {
        return 'uploads/' . $this->file->name;
    }

    /**
     * UploadForm::createTemporaryTable()
     * 
     * @param mixed $numColumns
     * @return
     */
    private function createTemporaryTable($numColumns)
    {
        try {
            $db = Yii::$app->db;
            $user_id = Yii::$app->user->getId();
            $q = "CREATE TABLE IF NOT EXISTS tmp_stock_" . $user_id . " (
            `id` INT NOT NULL AUTO_INCREMENT,";
            for ($i = 1; $i <= $numColumns; $i++) {
                $q .= " f$i varchar(255),";
            }
            $q .= " KEY (`id`)) ENGINE=MyISAM";
//die($q);
            $db->createCommand($q)->execute();
            $db->createCommand('truncate table tmp_stock_' . $user_id)->execute();
            return true;
        }
        catch (exception $ex) {
            return false;
        }
    }

    /**
     * UploadForm::truncateTable()
     * 
     * @return
     */
    public function truncateTable()
    {
        try {
            $db = Yii::$app->db;
            $user_id = Yii::$app->user->getId();
            $db->createCommand('delete from stock where userid=' . $user_id)->execute();
            return true;
        }
        catch (exception $ex) {
            return false;
        }
    }

    /**
     * UploadForm::getExcelData()
     * 
     * @return
     */
    private function getExcelData()
    {
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($this->getPath());
            $objeader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objeader->load($this->getPath());
            return $objPHPExcel->getSheet(0);
        }
        catch (exception $e) {
            return null;
        }

    }

    /**
     * UploadForm::getFormat()
     * 
     * @return
     */
    private function getFormat()
    {

        $db = Yii::$app->db;
        $user_id = Yii::$app->user->getId();
        $arr = $db->createCommand('SELECT * FROM fileformat where userid=' . $user_id)->queryAll();
        if (count($arr) > 0)
            return $arr;
        else
            return null;
    }

    /**
     * UploadForm::getData()
     * 
     * @return
     */
    public function getData()
    {
        try {

            //получаем 1-й лист книги Эксель
            $sheet = $this->getExcelData();

            $user_id = Yii::$app->user->getId();
            $db = Yii::$app->db;

            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $alphabet = ['A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6,'G'=>7,'H'=>8,'I'=>9,'J'=>10,'K'=>11,'L'=>12,'M'=>13,'N'=>14,'O'=>15,'P'=>16,'Q'=>17,'R'=>18,'S'=>19,'T'=>20,'U'=>21,'V'=>22,'W'=>23,'X'=>24,'Y'=>25,'Z'=>26];
            //создаем временную таблицу
            if ($this->createtemporaryTable($alphabet[$highestColumn])) {
                $table = "tmp_stock_" . $user_id;
                $cellData = $sheet->rangeToArray("A1:$highestColumn"."10", null, true, false);
                foreach($cellData as $key=>$val)
                    foreach($val as $k=>$v) {
                        $k++;
                        $fields[$key]["f$k"] = $v;
                    }
                foreach($fields as $val)
                    $db->createCommand()->insert($table, $val)->execute();
            }
            return $table;
        }
        catch (exception $e) {

        }
    }
    /**
     * UploadForm::showData()
     * 
     * @param mixed $table
     * @param integer $begin
     * @param integer $cnt
     * @return
     */
    public function showData($table, $begin = 0, $cnt = 10)
    {
        $db = Yii::$app->db;
        //$this->getData($mode);
        $data = $db->createCommand('SHOW COLUMNS FROM '.$table)->queryAll();
        foreach($data as $val)
        {
            if($val['Field']!='id')
                $str[]=$val['Field'];
                
        }
        
        $fields = implode(",",$str); 
        $data = $db->createCommand("SELECT $fields FROM $table limit $begin,$cnt")->queryAll();
        return $data;
    }
    public function addStock($fields,$table)
    {
        $user_id = Yii::$app->user->getId();
        $pattern="/[^0-9A-Za-z\\.]/i";
        $fields[2] = preg_replace($pattern,"#",$fields[2]);
        $codes = explode("#",$fields[2]);
        foreach($codes as $code) {
            if (isset($code))
                $q = "insert into stock select $fields[1],$fields[2],$code,$fields[3],$fields[4],$fields[5],$user_id,now() from " . $table;
        }
        $db = Yii::$app->db;
        $db->createCommand($q)->execute();
    }
}
