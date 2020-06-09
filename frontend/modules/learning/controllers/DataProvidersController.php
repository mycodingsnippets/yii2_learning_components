<?php

namespace frontend\modules\learning\controllers;

class DataProvidersController extends \yii\web\Controller{
    
    public function actionIndex(){
        return $this->render('index');
    }

    public function actionList(){
        $dataProvider = new \yii\data\ActiveDataProvider([
           'query' => \frontend\modules\learning\models\Testing::find()
                            ->where(['status' => 1])
                            ->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 2
            ]
        ]);
        
        $this->view->title = "Testing title";
        
        
        return $this->render('list',[
            'listDataProvider' => $dataProvider
        ]);
        
    }
    
}
