<?php

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'UOnItecRH5mfmJRUZlFtEeSKfsXBC6-S',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'text/json' => 'yii\web\JsonParser',
            ]
        ],
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::class,
            'key' => 'secret',
            'jwtValidationData' => \app\components\JwtValidationData::class,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'mongodb'=>[
            'class' =>'\yii\mongodb\Connection',
            'dsn'=>'mongodb://localhost:27017/test',
            'enableLogging' => true, // enable logging
            'enableProfiling' => true, // enable profiling
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                'POST v1/users/login'=>'user/login',
                'POST v1/users/register'=>'/user/register',
                'GET v1/users/<id>'=>'/user/queryuser',
                'DELETE v1/users/<id>'=>'/user/deleteuser',
                'PUT v1/users/<id>'=>'/user/updatepassword',

                'POST v1/todos/'=>'/todo/addtodo',
                'POST v1/todos/<id>'=>'/todo/updatetodo',
                'GET v1/todos/<id>'=>'/todo/querytodo',
                'DELETE v1/todos/<id>'=>'/todo/deletetodo',
                'DELETE v1/todos/batchDelete'=>'/todo/batchdeletetodo',
                'get v1/todos/'=>'/todo/querytodo',




                
            ],
        ],

    ],
];

return $config;
