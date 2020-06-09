<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2 class="truncate text-center">
                <?= yii\helpers\Html::a($model->title, ['post/view', 'slug'=>$model->slug]) ?>
            </h2>
            <hr>
            <p><?= $model->preview ?></p>
            <hr>
            <div class="text-right">
                <span><?= $model->updated_at ?></span>
            </div>
        </div>
    </div>
</div>