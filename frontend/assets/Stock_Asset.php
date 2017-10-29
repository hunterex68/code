<?php

namespace app\assets;
use yii\web\AssetBundle;

class StockAsset extends AssetBundle
{
public $basePath = '@webroot'; //алиас каталога с файлами, который соответствует @web
public $baseUrl = '@web';//Алиас пути к файлам
public $css = [



];
public $js = [

'/js/script4Stock.js',
    'css/jquery.fileupload.js',

];
public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}