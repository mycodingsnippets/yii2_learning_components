<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\learning\models\Testing */

$this->title = 'Update Testing: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Testings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="testing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
