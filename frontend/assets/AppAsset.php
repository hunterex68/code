<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Ochotnichenko oleg aka Alex Hunt <ohunterexe@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
   
    public $css = [
        'web/css/header.css',
        'web/css/style.css',
        'web/css/social.css',
        'web/css/animate.css',
        '//fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic',
        '//fonts.googleapis.com/css?family=Comfortaa|Cuprum|Lobster|Open+Sans+Condensed:300|PT+Sans+Narrow|Pattaya|Audiowide|Boogaloo|Comfortaa|Exo+2|Farsan|Gruppo|Jura|Pompiere|Squada+One|Ubuntu+Condensed|Unica+One',
    ];
    public $js = [

        //'//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js',
        "web/js/waypoints/lib/jquery.waypoints.min.js",
        'web/js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
