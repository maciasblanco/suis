<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'asdasdasd',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager'=>[
            'class'=>'yii\rbac\DbManager',
            'itemTable'=>'seguridad.auth_item',
            'itemChildTable'=>'seguridad.auth_item_child',
            'assignmentTable'=>'seguridad.auth_assignment',
            'ruleTable'=>'seguridad.auth_rule',
        ],
        'user' => [
            //'identityClass' => 'app\models\User',
            'identityClass' => 'mdm\admin\models\User',
            //'loginUrl' => ['site/login'],
            //'enableAutoLogin' => true,
            'authTimeout' => 60*20,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'db_saime' => require(__DIR__ . '/db_saime.php'),
        'bd_salud' => require(__DIR__ . '/bd_salud.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
            ],
        ],
        'assetManager'=>[
            'bundles'=>[
                'yii\web\JqueryAsset' => [
                    'jsOptions'=>[
                        'position'=>\yii\web\View::POS_HEAD
                    ],
                ],
            ],
        ],
        'as access' => [
            'class'=>'mdm\admin\components\AccessControl',
            'allowActions' => [
                'site/error',
                'site/captcha',
            ],
        ],
    ],
    'aliases' => [
        '@mdm/admin'=>'@vendor/yii2-admin',
        '@mpdf'=>'@vendor/mpdf/src',
    ],
    'modules' => [
        'admin'=>[
            'class'=>'mdm\admin\Module',
            'layout' => 'left-menu',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
