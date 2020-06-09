<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="category-form">
    <?php $form= \yii\widgets\ActiveForm::begin(); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'parent_id')->dropDownList($parentData, ['prompt' => '--Select Parent--']) ?>
        <div class="form-group">
            <?= yii\helpers\Html::submitButton($model->isNewRecord ? 'Create' : 'Update', 
                                                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php    \yii\widgets\ActiveForm::end(); ?>
</div>

