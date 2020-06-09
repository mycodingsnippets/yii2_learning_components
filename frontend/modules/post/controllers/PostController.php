<?php

namespace frontend\modules\post\controllers;

use Yii;
use frontend\modules\post\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {   
        //permissions are generic
        //permssions are assigned to roles
        //roles are assigned to user
        //and users are checked for access
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'], 
                        'matchCallback' => function($rule, $action){
                            if(\Yii::$app->user->can('admin')){
                                return true;
                            }
                            return false;
                        }
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        return $this->render('view', [
            'model' => $this->findModelBySlug($slug),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        if(\Yii::$app->user->can('admin')){
            $model = new Post();

            if ($model->load(Yii::$app->request->post())) {

                $model->imageFile = \yii\web\UploadedFile::getInstance($model, 'imageFile');

                if($model->uploadAndSave()){
                    return $this->redirect(['view', 'slug' => $model->slug]);
                }

            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }else{
            throw new \yii\web\ForbiddenHttpException("You are not allowed to access this");
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {
        if(\Yii::$app->user->can('admin')){
            $model = $this->findModelBySlug($slug);

            if ($model->load(Yii::$app->request->post())) {

                $model->imageFile = \yii\web\UploadedFile::getInstance($model, 'imageFile');

                if($model->uploadAndSave()){
                    return $this->redirect(['view', 'slug' => $model->slug]);
                }

            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new \yii\web\ForbiddenHttpException("You are not allowed to access this");
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($slug)
    {
        if(\Yii::$app->user->can('admin')){
            $model = $this->findModelBySlug($slug); 
            if(isset($model->image)){
                unlink($model->image);
            }
            $model->delete();

            return $this->redirect(['index']);
        }else{
            throw new \yii\web\ForbiddenHttpException("You are not allowed to access this");
        }
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    protected function findModelBySlug($slug){
        if(($model = Post::find()->andWhere(['slug'=>$slug])->one()) !== null){
            return $model;
        }
        
        throw new NotFoundHttpException("The requested page does not exist");
    }
}
