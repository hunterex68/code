<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'language' => 'ru-RU',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

            ],
        ],
        'i18n' => [
            'translations'=>[
                // app* - это шаблон, который определяет, какие категории
                // обрабатываются источником. В нашем случае, мы обрабатываем все, что начинается с app
                'app'=>[
                    'class'=>yii\i18n\PhpMessageSource::className(),
                    //
                    'basePath'=>'@app/messages',
                    // исходный язык
                    'sourceLanguage'=>'ru-RU',
                    // определяет, какой файл будет подключаться для определённой категории
                    'fileMap'=>[
                        'app'=>'app.php',
                        'app/error'=>'error.php',
                    ]
                ],
            ]
    ],
        ],
    'params' => $params,
];
