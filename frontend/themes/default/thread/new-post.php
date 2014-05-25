
<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Thread $model
 */

$this->title = '发表回帖: ' . $thread['title'];
$this->buildBreadcrumbs($currentBoard['id']);
$this->addBreadcrumb($thread->title,['view', 'id' => $thread['id']]);
$this->addBreadcrumb('发表');
?>
<div class="thread-update">

    <h1><?= Html::encode($this->title) ?></h1>
   
     <?php $form = ActiveForm::begin(['id'=>'thread']); ?>

     	<input type="hidden" id="post-board_id" name="Post[board_id]" value="<?php echo $currentBoard['id']?>"/>
    	<input type="hidden" id="post-thread_id" name="Post[thread_id]" value="<?php echo $thread['id']?>"/>
    	<input type="hidden" id="post-thread_title" name="Post[thread_title]" value="<?php echo $thread['title']?>"/>
	    	
    	<?= $form->field($model, 'body')->textarea(['rows' => 8]) ?>
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>


   
