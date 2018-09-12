<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
return [
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'vfwuQepNroSzpkaKoBsi8iHmm1Ye8xu4',
    ],
    'view' => [
        'theme' => [
            'pathMap' => [
                //'@app/views' => '@vendor/jucksearm/yii2-theme-devoops/views'
                //'@app/views' => '@app/themes/devoops/views'
                '@app/views' => '@app/views'
            ],
        ],
    ],
    'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'dateFormat' => 'php:m/d/Y',
        'datetimeFormat' => 'php:Y-m-d H:i:s',
        'timeFormat' => 'php:H:i:s',
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'user' => [
        'identityClass' => 'app\models\User',
        'enableAutoLogin' => true,
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
    'authManager' => [
        'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
    ],
    'urlManager' => [
        'class' => 'yii\web\UrlManager',
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'enableStrictParsing' => false,
        'rules' => [
            '<controller:\w+>/<id:\d+>' => '<controller>/view',
            '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        ],
    ],
    
    /*
    'urlManager' => [
        'class' => 'yii\web\UrlManager',
        'enablePrettyUrl' => true,
        //'enableStrictParsing' => true,
        'showScriptName' => false,
        'rules' => [
            //[
            //    'class' => 'yii\rest\UrlRule',
            //    'controller' => 'myrest',
            //'except'=>['view'],
            //],
            '<controller:\w+>/<id:\d+>' => '<controller>/view',
            '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        ],
    ],
     * 
     */
     
];
