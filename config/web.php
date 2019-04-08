<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$db_saime = require(__DIR__ . '/db_saime.php');

$config = [
    'id' => 'suis',
    'name' => 'SUIS',
    'language' => 'es',
    'timeZone' => 'America/Caracas',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'mainAdminlte',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        //'@mdm/admin'=>'@vendor/yii2-admin',
        //'@mpdf'=>'@vendor/mpdf/src',
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/mainAdminlte.php',
        ],
        'sicasmi' => [
            'class' => 'app\modules\sicasmi\SicasmiModule',
        ],

        'ev25' => [
            'class' => 'app\modules\ev25\EV25Module',
        ],

        'epi10' => [
            'class' => 'app\modules\epi10\Epi10Module',
        ],
        /*'pqn' => [
            'class' => 'app\modules\pqn\PqnModule',
        ],*/
        'mortalidad' => [
           'class' => 'app\modules\mortalidad\MortalidadModule',
        ],
        'org-sani' => [
            'class' => 'app\modules\organizacion_sanitaria\OrgSaniModule',
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'JkyRViIV13kfpHYW__VBqDaf8n-adlO0',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'authTimeout' => 60*20,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable'=>'seguridad.auth_item',
            'itemChildTable'=>'seguridad.auth_item_child',
            'assignmentTable'=>'seguridad.auth_assignment',
            'ruleTable'=>'seguridad.auth_rule',
        ],
        'session' => [
            'name' => '3927fe910e683f4d85c593ba2b7032db',
            'savePath' => sys_get_temp_dir(),
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
        'db' => $db,
        'db_saime' => $db_saime,
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
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/logout',
            'site/index',
            'site/error',
            'site/sidebar',
            //'*',
        ]
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
        'generators' => [
            'modalCrud' => [
                'class' => 'app\templates\modal_crud\Generator',
                'templates' => [
                    'default' => '@app/templates/modal_crud/default',
                ]
            ],
            'model' => [
                'class' => 'app\templates\model\Generator',
            ],
        ],
    ];
}

return $config;
