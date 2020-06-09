<?php

namespace api\modules\v1\controllers;

class TestingController extends \yii\web\Controller{
    
//    Implementations of Identity Interface
//            findIdentity($id)
//            findIdentityByAccessToken($token, $type=null)
//            getId()
//            getAuthKey()
//            validateAuthKey()
//    Other important methods of User class are
//            findByUsername($username)
//            generatePassword($password)
//            validatePassword($password)
//    We can configure password hashing strategy in main.php with
//            'security' => [
//                'passwordHashStrategy' => 'password_hash'
//            ]
    
//    Required DB attributes for API
//            Access Token
//            Access Token Expiry
//            Refresh Token
//            Refresh Tokem Expiry
    
    
    public function behaviors() {
        parent::behaviors();
        
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\CompositeAuth::className(),
            'authMethods' => [
                \yii\filters\auth\HttpBearerAuth::className()
            ],
            'only' => ['test']
        ];
        
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*']
            ]
        ];
        $behaviors['authenticator']['except'] = ['options', 'login', 'signup'];
        
        $behaviors['access'] = [
            'class' => \yii\filters\AccessControl::className(),
            'only' => ['test'],
            'rules' => [
                [
                    'actions' => ['test'],
                    'allow' => true,
                    'roles' => ['@']
                ]
            ]
        ];
        
        $behaviors['verbFilter'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'test' => ['POST']
            ]
        ];
        
        return $behaviors;
    }
    
    public function actionTest(){
        $response = new \api\modules\v1\utilities\Response();
        return $this->asJson($response->send(200, "Testing"));
    }
    
    public function actionFree(){
        $response = new \api\modules\v1\utilities\Response();
        return $this->asJson($response->send(201, "Success"));
    }
}
