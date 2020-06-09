<?php

namespace frontend\modules\rbac\controllers;

use yii\web\Controller;

/**
 * Default controller for the `rbac` module
 */
class DefaultController extends Controller
{
    
    public function behaviors() {
        parent::behaviors();
    
        $behaviors['access'] = [
            'class'=> \yii\filters\AccessControl::className(),
            'rules' => [
                [
                    'allow'=> true,
                    'roles' => ['@'],
                    'matchCallback' => function($rule, $action){
                        $module = \Yii::$app->controller->module->id;
                        $action = \Yii::$app->controller->action->id;
                        $controller = \Yii::$app->controller->id;
                        $route = "$module/$controller/$action";
                        if(\Yii::$app->user->can($route)){
                            return true;
                        }
                    }
                ]
            ]
        ];
                
        return $behaviors;
    }
    
    public function actionIndex(){
        return "Index";
    }
    
    public function actionCreate(){
        return "Create";
    }
    
    public function actionView(){
        return "View";
    }
    
    public function actionUpdate(){
        return "update";
    }
    
    public function actionDelete(){
        return "Delete";
    }
}

