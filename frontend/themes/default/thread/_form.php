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

    <input type="hidden" id="thread-title" name="Thread[title]" value="<?php echo $currentBoard['id'];?>">

    <?= $form->field($model, 'title')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 8]) ?>
    
    <?= $form->field($model, 'status')->dropDownList(['1'=>'·¢²¼','0'=>'²Ý¸å']) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
