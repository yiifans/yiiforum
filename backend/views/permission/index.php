<?php

use yii\helpers\Html;
use yii\grid\GridView;
use base\YiiForum;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\AuthItemSearch $searchModel
 */

$this->title = '权限管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index">

 <table class="table">
	<tr>
		<td width="200">
			<div class="tbox">
				<div class="bd">
					<ul>
						<?php foreach ($categories as $category):?>
						<li><?= Html::a($category->description, ['index','category'=>$category->name]) ?></li>
						<?php endforeach;?>
					</ul>
				</div>
			</div>
		</td>
		<td>  
		    <p>
		    	
		        <?= Html::a('添加权限', ['create','category'=>$currentCategory], ['class' => 'btn btn-success']) ?>
		        <?= Html::a('刷新缓存', ['refresh', 'category'=>$currentCategory], ['class' => 'btn btn-success']) ?>
		    </p>
		
		    <table class="table">
			    <tr class="tb_header">
			      
			      <th>标题</th>
			      <th>描述</th>
			      <th width="80">do</th>
			    </tr>
				<?php foreach ($items as $row ): ?>
				<tr>
				
				<td><?php echo $row->name?></td>
				<td><?php echo $row->description?></td>
				<td>
				
					<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update','id'=>$row->name, 'category'=>$currentCategory]) ?>
					<?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete','id'=>$row->name, 'category'=>$currentCategory],[
							
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
