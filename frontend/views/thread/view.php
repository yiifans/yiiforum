<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Thread $model
 */

//$this->params['breadcrumbs'][] = ['label' => $currentBoard['name'], 'url' => ['index&board='.$currentBoard['id']]];
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $currentBoard['name'], 'url' => ['index&boardid='.$currentBoard['id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thread-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php foreach ($posts as $row):?>
    <div class="tbox border" style="min-height: 120px;">
	    <table class="post" style="margin-bottom: 0px;">
	    	<tr>
	    		<td class="post-user-column header">
	    			<div class="bottom-dashed">
	    				<span><?php echo $row['user_name'];?></span>
	    			</div>
	    		</td>
	    		<td class="post-data-column header">
	    			<div class="bottom-dashed">
	    				发表于：<span><?php echo $row['create_time'];?></span>
	    			</div>
	    		</td>
	    	</tr>
	    	<tr style="height: 120px;">
	    		<td class="post-user-column body">
	    			<div>
	    				<span></span>
	    			</div>
	    		</td>
	    		<td class="post-data-column body content">
	    			<div>
    					<?php echo $row['body'];?>
    				</div>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td class="post-user-column footer">
	    		</td>
	    		<td class="post-data-column footer">
	    			<div class="top-dashed">
    					<span>回复</span><span>编辑</span><span>支持</span><span>反对</span>
    				</div>
	    		</td>
	    	</tr>
	    </table>
    </div>
    <?php endforeach;?>
   
    <?php $form = ActiveForm::begin([
			'id'=>'NewPost',
    		'action' => $this->homeUrl.'?r=thread/new-post&thread='.$model['id'],
	]); ?>

    	<input type="hidden" id="post-thread_id" name="Post[thread_id]" value="<?php echo $model['id']?>"/>
    	
        <div class="form-group field-post-title required">
			<label class="control-label" for="post-title">Title</label>
			<input type="text" id="post-title" class="form-control" name="Post[title]"  maxlength="256">
			<p class="help-block"></p>
		</div>

	    <div class="form-group field-post-body">
			<label class="control-label" for="post-body">Body</label>
			<textarea id="post-body" class="form-control" name="Post[body]" rows="8" cols="6"></textarea>
			<div class="help-block"></div>
		</div>

	    <div class="form-group">
	        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
	    </div>

    <?php ActiveForm::end(); ?>
    

</div>
