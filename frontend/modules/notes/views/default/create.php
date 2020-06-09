<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="category-form">
    <?php $form= \yii\widgets\ActiveForm::begin(); ?>
    
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'note')->textarea() ?>
        
        <?= $form->field($model, 'published_date')->textInput() ?>
    
        <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => '--Select Category--']) ?>
        
        <div class="form-group">
            <?= yii\helpers\Html::submitButton($model->isNewRecord ? 'Create' : 'Update', 
                                                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php    \yii\widgets\ActiveForm::end(); ?>
</div>