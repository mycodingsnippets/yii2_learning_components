<?php

namespace api\controllers;



class SiteController extends \yii\web\Controller{
                
                public function actionIndex(){
                        $response = new \api\modules\v1\utilities\Response();
                        return $this->asJson($response->send(200, "Api Endpoints will be listed Shortly"));
                }
                
//                public function actionTest(){
//                        
//                        if(($exception = \Yii::$app->getErrorHandler()->exception) === null){
//                                $exception = new \yii\web\NotFoundHttpException("Page Not Found");
//                        }
//                        
//                        $response = new \api\modules\v1\utilities\Response();
//                        $status = null;
//                        
//                        if($exception instanceof \yii\web\HttpException){
//                                $status = $exception->getCode();
//                        }else{
//                                $status = 500;
//                        }
//                        
//                        return $this->asJson($response->send($status, $exception->getMessage()));
//                }
        
}
