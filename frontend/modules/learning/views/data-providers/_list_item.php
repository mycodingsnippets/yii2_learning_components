<article class="item" data-key="<?= $model->id ?>">
    <h2 class="title">
        <?= \yii\helpers\Html::a(\yii\helpers\Html::encode($model->title), \yii\helpers\Url::toRoute(['testing/view', 'id'=>$model->id]), ['title'=>$model->title]) ?>
    </h2>
    <div class="item-excerpt">
        <?= \yii\helpers\Html::encode($model->data);?>
    </div>
</article>