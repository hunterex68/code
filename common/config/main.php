<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

            'brandsLana' => [
                'class' => 'app\components\lanaBr'],
            'brandsBase' => [
                'class' => 'app\components\baseBr'],
            'replacements' => [
                'class' => 'yii\components\lanaRepl'],
            'priceOnline' => [
                    'class' =>'yii\components\mega'],
            'priceUA' => [
                    'class' => 'yii\components\stock'],
            'priceEUR' => [
                    'class' => 'yii\components\plnd'],
            'priceEUR' => [
                    'class' => 'yii\components\sclub'],
            'priceUSA' => [
                    'class' => ['yii\components\amt'],
                ],
            ],
];
