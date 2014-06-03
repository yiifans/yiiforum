<?php

use yii\helpers\Html;
use yii\grid\GridView;
use base\YiiForum;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\AuthItemSearch $searchModel
 */

$this->title = '角色管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index">

<table class="table">
	<tr>
		<td width="200">
			<div class="tbox">
				<div class="bd">
					<ul>
						<?php foreach ($groups as $group):?>
						<li><?= Html::a($group['description'], ['index','group'=>$group['name']]) ?></li>
						<?php endforeach;?>
					</ul>
				</div>
			</div>
		</td>
		<td>
		    <p>
		    	
		        <?= Html::a('添加角色', ['create', 'group'=>$currentGroup], ['class' => 'btn btn-success']) ?>
		        <?= Html::a('刷新缓存', ['refresh', 'group'=>$currentGroup], ['class' => 'btn btn-success']) ?>
		    </p>
		
		    <table class="table">
			    <tr class="tb_header">
			      
			      <th>角色</th>
			      <th>描述</th>
			      <th width="120">do</th>
			    </tr>
				<?php foreach ($items as $row ): ?>
				<tr>
				
				<td><?php echo $row['name']?></td>
				<td><?php echo $row['description']?></td>
				<td>
					<?= Html::a('设置权限', ['permission','id'=>$row['name'], 'group'=>$currentGroup]) ?>
					<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update','id'=>$row['name'], 'group'=>$currentGroup]) ?>
					<?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete','id'=>$row['name'], 'group'=>$currentGroup],[
							
							'data' => [
								'confirm' => 'Are you sure you want to delete this item?',
								'method' => 'post',
							],
					]) ?>
				</td>
				</tr>
				<?php endforeach;?>
			</table>
	
		</td>
	</tr>
</table>
</div>
