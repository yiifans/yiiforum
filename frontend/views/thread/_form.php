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

    <div class="form-group field-thread-body">
		<label class="control-label" for="thread-body">Body</label>
		<textarea id="thread-body" class="form-control" name="Thread[body]" rows="8" cols="6"><?php echo $body;?></textarea>
		<div class="help-block"></div>
	</div>

    

    <?= $form->field($model, 'status')->dropDownList(['1'=>'·¢²¼','0'=>'²Ý¸å']) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
