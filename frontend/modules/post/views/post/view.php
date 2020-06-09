<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\post\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        <hr>
        
        <?php if(isset($model->image)){ ?>
        <img src="<?= yii\helpers\Url::base() . '/' . $model->image ?>" class="img-thumbnail  ">
        <?php } ?>
        
        <?= $model->text ?>
        <hr>
        <div class="row">
            <div class="col-xs-6">
                <?= Html::a('Update', ['update', 'slug' => $model->slug], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'slug' => $model->slug], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="col-xs-6">
                <p class="text-right">
                    <time class="timeago badge" datetime="<?= $model->updated_at ?>"></time>
                </p>
            </div>
        </div>
        
    </div>
</div>

   

