<?php


$baseUrl = \yii\helpers\Url::home();
$this->title = 'Testing Form';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'description', 'content' => 'I am learning yii2']);
//If files are large, we can register a separate App Asset for this view file
$this->registerJsFile($baseUrl . '/js/test.js', ['position' => $this::POS_HEAD]);
?>

<?php
if(Yii::$app->session->hasFlash('success')){
    echo Yii::$app->session->getFlash('success');
}
?>

<?php $form= yii\widgets\ActiveForm::begin(); ?>
<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'email'); ?>
<?= yii\helpers\Html::submitButton('Submit', ['class' => 'btn btn-success']); ?>
<?php yii\widgets\ActiveForm::end(); ?>

<?php
$script = <<< JS
        console.log("This is testing from view file");
JS;
$this->registerJs($script);
?>