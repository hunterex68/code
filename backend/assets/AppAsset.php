<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "../css/bootstrap.min.css",
        "../css/bootstrap-responsive.min.css",
        "http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600",
        "../css/font-awesome.css",
        "../css/style.css",
        "../css/pages/dashboard.css",

        '../css/site.css',
    ];
    public $js = [
        //"js/jquery-1.7.2.min.js",
        "js/excanvas.min.js",
        "js/chart.min.js",
        //"js/bootstrap.js",
        "js/full-calendar/fullcalendar.min.js",
        "js/base.js",
        "js/script.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
}
