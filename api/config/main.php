<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\ApiModule',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
            'parsers' => [
                'application/json' => yii\web\JsonParser::class
            ],
            'enableCsrfValidation' => false,
            'enableCookieValidation' => false
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => null
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
        'response' => [
                'class' => 'yii\web\Response',
                'on beforeSend' => function($event){
                        $response = $event->sender;
                        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                        if($response->data !== null){
                                if(!$response->isSuccessful){
                                        if(($exception = \Yii::$app->getErrorHandler()->exception) === null){
                                                $exception = new \yii\web\NotFoundHttpException("Page Not Found");
                                        }
                                        $response->data = [
                                                 'message' => $exception->getMessage()
                                        ];
                                }
                        }
                }
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest']
        ]
    ],
    'params' => $params,
];
