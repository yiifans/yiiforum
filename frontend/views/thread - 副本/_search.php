<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\search\ThreadSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="thread-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'board_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'user_name') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'modify_time') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'posts') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'note1') ?>

    <?php // echo $form->field($model, 'note2') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
