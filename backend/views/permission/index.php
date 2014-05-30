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
		    	
		        <?= Html::a('添加权限', ['create','category'=>YiiForum::getGetValue('category')], ['class' => 'btn btn-success']) ?>
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
					<a href="index.php?r=permission/update&id=<?php echo $row->name?>"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="index.php?r=permission/delete&id=<?php echo $row->name?>" data-confirm="Are you sure to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
				</tr>
				<?php endforeach;?>
			</table>
		</td>
	</tr>
</table>
</div>
