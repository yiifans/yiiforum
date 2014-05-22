<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Thread $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="thread-form">

    <?php $form = ActiveForm::begin(['id'=>'thread']); ?>

    

    <?= $form->field($model, 'title')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 8]) ?>
    
    <?= $form->field($model, 'status')->dropDownList(['1'=>'发布','0'=>'草稿']) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
