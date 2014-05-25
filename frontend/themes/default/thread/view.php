<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use base\YiiForum;

/**
 * @var yii\web\View $this
 * @var common\models\Thread $model
 */

//$this->params['breadcrumbs'][] = ['label' => $currentBoard['name'], 'url' => ['index&board='.$currentBoard['id']]];
$this->title = $thread->title;
$this->buildBreadcrumbs($currentBoard['id']);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thread-view">
	<div class="tbox">
		<div class="floatl">
			<?= Html::a('发帖', ['new-thread','boardid'=>$currentBoard['id']], ['class' => 'btn btn-success']) ?>
		</div>
		<div class="floatr">
			<?php echo LinkPager::widget([
		   		'pagination' => $pages,
		   	]);?>
		</div>
	</div>
	
    <div class="tbox post-list">
	    <table class="post border">
	    	<tr>
	    		<td class="post-left-column header">
	    			<div>
		    			查看：<span><?php echo $thread['views'];?></span>回复：<span><?php echo $thread['posts'];?></span>
		    		</div>
	    		</td>
	    		<td class="post-right-column header">
	    			<div>
		    				<b><?= Html::encode($thread['title']) ?></b>
	    			</div>
	    		</td>
	    	</tr>	    		    	
	    </table>
	    
	    <?php 
	    	$floor=0;
	    	foreach ($rows as $row)
	    	{
	    		$floor+=1;
	    ?>
	    <div id="post_<?php echo $row['id'];?>">
		    <table class="post border">
		    	<tr>
		    		<td class="post-left-column header">
		    			<div class="dashed-border-b padding-b8">
		    				<span><?php echo $row['user_name'];?></span>
		    			</div>
		    		</td>
		    		<td class="post-right-column header">
		    			<div class="dashed-border-b padding-b8">
		    				发表于：<span><?php echo $row['create_time'];?></span> <span class="floatr"><?php echo $floor;?>楼</span>
		    			</div>
		    		</td>
		    	</tr>
		    	<tr style="height: 80px;">
		    		<td class="post-left-column body">
		    			<div>
		    				<span></span>
		    			</div>
		    		</td>
		    		<td class="post-right-column body content">
		    			<div>
	    					<?php echo $row['body'];?>
	    				</div>
		    		</td>
		    	</tr>
		    	<?php if($row['user_id']==YiiForum::getIdentity()->id):?>
		    	<tr>
		    		<td class="post-left-column footer">
		    		</td>
		    		<td class="post-right-column footer">
		    			<div class="dashed-border-t">
	    					<span>回复</span>
	    					<span>
	    					<?php 
	    						if($floor==1)
	    						{
	    							echo Html::a('编辑', ['edit-thread', 'id' =>$thread['id'],'boardid'=>$currentBoard['id']]).'</span><span>';
	    							echo Html::a('删除', ['delete', 'id' =>$thread->id,'boardid'=>$currentBoard['id']], [
		    							'data' => [
			    							'confirm' => 'Are you sure you want to delete this item?',
			    							'method' => 'post',
		    							],
	    							]);
	    						}
	    						else 
	    						{
	    							echo Html::a('编辑', ['edit-post','id'=>$row['id'],'boardid'=>$currentBoard['id']]);	
	    						}
	    					?>
	    					</span><span>支持</span><span>反对</span>
	    				</div>
		    		</td>
		    	</tr>
		    	<?php endif;?>
		    </table>
	    </div>
	    <?php }?>
    </div>
   	<div class="tbox">
		<div class="floatl">
			<?= Html::a('发帖', ['new-thread','boardid'=>$currentBoard['id']], ['class' => 'btn btn-success']) ?>
		</div>
		<div class="floatr">
			<?php echo LinkPager::widget([
		   		'pagination' => $pages,
		   	]);?>
		</div>
	</div>
   <div class="tbox">
       <?php $form = ActiveForm::begin([
				'id'=>'newPost',
	    		'action' => YiiForum::getHomeUrl().'?r=thread/new-post&threadid='.$thread['id'],
		]); ?>
	
			<input type="hidden" id="post-board_id" name="Post[board_id]" value="<?php echo $currentBoard['id']?>"/>
	    	<input type="hidden" id="post-thread_id" name="Post[thread_id]" value="<?php echo $thread['id']?>"/>
	    	<input type="hidden" id="post-thread_title" name="Post[thread_title]" value="<?php echo $thread['title']?>"/>
	    	
	    	<?php
	    		$label='回帖'.Html::a('(高级)', ['new-post','threadid'=>$thread['id'],'boardid'=>$currentBoard['id']]);
	    		echo $form->field($newPost, 'body',['template'=>"'.$label.'\n{input}\n{hint}\n{error}"])->textarea(['rows' => 6]);
	    	 ?>
	    	
		    <div class="form-group">
		        <?= Html::submitButton('回帖', ['class' => 'btn btn-success']) ?>
		    </div>
	
	    <?php ActiveForm::end(); ?>
   </div>

    

</div>
