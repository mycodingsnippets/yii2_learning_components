<?php

namespace frontend\modules\learning\controllers;

use yii\web\Controller;

/**
 * Default controller for the `learning` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionTestForm(){
        $model = new \frontend\modules\learning\models\RequestFormModel();
        $response = new \frontend\modules\learning\models\ResponseModel();
        
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            \Yii::$app->session->setFlash('success', 'You have entered the data correctly');
            
            $response->status = 201;
            $response->message = "Successfully Submitted";
            return $this->asJson($response->send());
        }
        
        return $this->render('testForm', [
            'model' => $model
        ]);
        
    }
    
    public function actionTestData(){
        $data = [
            '100' => [
                'id' => '100',
                'username' => 'admin',
                'password' => 'admin',
                'authKey' => 'test100key',
                'accessToken' => '100-token'
            ],
            '101' => [
                'id' => '101',
                'username' => 'demo',
                'password' => 'demo',
                'authKey' => 'test101key',
                'accessToken' => '101-token'
            ]
        ];
        
        return $this->render('testData', [
            'data' => $data
        ]);
    }
}
