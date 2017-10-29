<?php
namespace app\assets;
use yii\web\AssetBundle;

class PriceAsset extends AssetBundle
{
public $basePath = '@webroot'; //алиас каталога с файлами, который соответствует @web
public $baseUrl = '@web';//Алиас пути к файлам
public $css = [

//'https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css',
'css/dataTables.jqueryui.css',

];
public $js = [

    'js/DataTables/media/js/jquery.dataTables.js',
    'js/script4price.js',

];
    public $depends = [
        'yii\web\jQueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
//public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}