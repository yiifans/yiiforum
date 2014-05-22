<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\ThreadSearch $searchModel
 */

$this->title = $currentBoard['name'];
$this->params['breadcrumbs'][] = ['label' => $currentBoard['name'], 'url' => ['index&boardid='.$currentBoard['id']]];
?>
<div class="thread-index">


    <p>
        <?= Html::a('发帖', ['create&boardid='.$currentBoard['id']], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="thread-list border">
    	<tr>
    		<th>主题</th>
    		<th width="120px">作者</th>
    		<th width="120px">回复/查看</th>
    		<th width="120px">最后发表</th>
    	</tr>
    	<?php foreach ($threads as $row ):?>
    	<tr>
    		<td><a href="<?php echo $this->homeUrl.'?r=thread/view&id='.$row['id']?>"><?php echo $row['title'];?></a></td>
    		<td class="author"><?php echo $row['user_name'];?><br/><?php $this->showTime($row['create_time']);?></td>
    		<td><?php echo $row['posts'];?>/<?php echo $row['views']?></td>
    		<td class="last-author"><?php echo $row['user_name'];?><br/><?php echo $this->showTime($row['create_time'],'Y-m-d H:i');?></td>
    	</tr>
    	<?php endforeach;?>
    </table>
   <div class="tbox border">
    
    <?php
    
	
    echo LinkPager::widget([
   		'pagination' => $pages,
   ]);?>
    </div>

</div>
