<div class="container">
     <?= yii\widgets\ListView::widget([
         'dataProvider' => $dt_posts,
         'itemView' => '_post',
         'layout' => '<div class="row">{items}</div><div class="text-center">{pager}</div>'
     ]) ?>
</div>