
<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Thread $model
 */

$this->title = '更新回帖: ' . $thread->title;
$this->buildBreadcrumbs($currentBoard['id']);
$this->addBreadcrumb($thread->title,['view', 'id' => $thread->id]);
$this->addBreadcrumb('更新');
?>
<div class="thread-update">

    <h1><?= Html::encode($this->title) ?></h1>
   
     <?php $form = ActiveForm::begin(['id'=>'thread']); ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 8]) ?>
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>


   
