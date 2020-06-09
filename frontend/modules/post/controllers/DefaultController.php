<?php

namespace frontend\modules\post\controllers;

use yii\web\Controller;

/**
 * Default controller for the `post` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
           'query' => \frontend\modules\post\models\Post::find()
                        ->orderBy('updated_at DESC'),
            'pagination' => [
                'pageSize' => 3
            ]
        ]);
        
        return $this->render('index', [
            'dt_posts' => $dataProvider
        ]);
    }
}
