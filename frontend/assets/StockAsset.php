<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 26.02.2017
 * Time: 23:38
 */
namespace app\assets;
use yii\web\AssetBundle;

class StockAsset extends AssetBundle
{
    public $basePath = '@webroot'; //алиас каталога с файлами, который соответствует @web
    public $baseUrl = '@web';//Алиас пути к файлам
    public $css = [

        'css/jquery.fileupload.css',

    ];
    public $js = [

        '/js/script4Stock.js',
    ];
    //public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}