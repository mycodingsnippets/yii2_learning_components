<?php

namespace frontend\modules\notes\controllers;

use yii\web\Controller;

/**
 * Default controller for the `notes` module
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
    
    public function actionTest(){
        return "Testing";
    }
    
    public function actionCreate(){
        $notes = new \frontend\modules\notes\models\Notes();
        
        $category = new \frontend\modules\notes\models\Category();
        $categoryData = \yii\helpers\ArrayHelper::map($category->getAllCategory(), 'id', 'name');
        
        $notes->created_at = time();
        $notes->updated_at = time();
        
        if($notes->load(\Yii::$app->request->post()) && $notes->save()){
            return $this->redirect(['index']);
        }
        
        return $this->render('create', [
           'model' => $notes,
            'categories' => $categoryData
        ]);
    }
    
    public function actionCreateCategory(){
        $model = new \frontend\modules\notes\models\Category();
        
        $parentData = $model->getCategoryParent();
        if(empty($parentData))
            $parentData = [];
        
        
        if($model->load(\Yii::$app->request->post())){
            if($model->save()){
                return $this->redirect(['index']);
            }else{
                print_r($model->errors);
                die();
            }
        }
        
        return $this->render('_category-create', [
            'model' => $model,
            'parentData' => $parentData
        ]);
    }
    
    
}
