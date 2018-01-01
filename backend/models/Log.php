<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.12.2016
 * Time: 12:41
 */

namespace backend\models;

use Yii;
use backend\components\Utils;


class Log
{
    /**
     * @param $msg
     * @param bool|false $append
     * @param null $filename
     * @return bool
     */
    static public function toFile($msg, $append = false, $filename = null){
        if(empty($filename)){
            $filename = Utils::settings('TEMP_LOG_FILENAME');
        }
        return self::writeToFile($msg, $append, $filename);
    }


    /**
     * @param $msg
     * @param bool|true $append
     * @param string $filename
     */
    public static function toGlobalLog($msg, $append = true, $filename = 'global_log.txt') {
        if (Utils::settings('GLOBAL_LOG_ENABLE')) {
            self::writeToFile($msg, $append, $filename);
        }
    }


    /**
     * @param $msg
     * @param bool|false $append
     * @param null $filename
     * @return bool
     */
    private static function writeToFile($msg, $append = false, $filename = null){
        if(empty($filename)){
            $filename = Utils::settings('TEMP_LOG_FILENAME');
        }
        if (!Utils::settings('TEMP_LOG_ENABLE') && $filename == Utils::settings('TEMP_LOG_FILENAME')){
            return true;
        }
		
        $mode = ($append) ? "a+" : "w+";
        $dir = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'logs';
        $file = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $filename;
        $ret =  false;
        if(is_dir($dir) && ((file_exists($file) && is_writable($file))
				|| (!file_exists($file) && is_writable(Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR))) ){
            set_error_handler(function ($errno, $errstr, $errfile, $errline){
                throw new \Exception($errstr, $errno);
            }, E_ALL);
            try{
                $handler = @fopen($dir.DIRECTORY_SEPARATOR.$filename,$mode);
            }  catch (\Exception $e){
                return false;
            }
            restore_error_handler();

            if(is_object($msg) || is_array($msg)){
                ob_start();
                print_r($msg);
                $msg = ob_get_clean();
            }
            $ret = fwrite($handler,$msg."\n") !== false;
            fclose($handler);
        }
        return $ret;

    }

    /**
     * reorder fields in array similar to old project
     *
     * @param array $dataList
     * @return array
     */

}