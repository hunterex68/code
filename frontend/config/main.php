<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'ru-RU',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'on afterlogin'=>function($event){
                common\models\User::updateLastLogin($event);
                common\components\BaseUtilites::setCookies($event);
                //$user = $event->sender->identity;
                //$user->updateAttributes(['logged_at'=>time()]);
                //SsetCoockies($user);
            }
        ],
        'request' => [
            'cookieValidationKey' => 'partcom',
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'mailer' =>[
            'class' => 'yii\swiftmailer\Mailer',

        ],

    ],
    'params' => $params,
];
