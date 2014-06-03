<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\UserSearch $searchModel
 */

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
	    <tr class="tb_header">
	      <th>ID</th>
	      <th>用户</th>
	      
	      <th width="120">do</th>
	    </tr>
		<?php foreach ($rows as $row ): ?>
		<tr>
		<td><?php echo $row['id']?></td>
		<td><?php echo $row['username']?></td>
		<td>
			
			<?= Html::a('设置角色', ['role','id'=>$row->id]) ?>
		
			<a href="index.php?r=user/update&id=<?php echo $row->id?>"><span class="glyphicon glyphicon-pencil"></span></a>
			<a href="index.php?r=user/delete&id=<?php echo $row->id?>" data-confirm="Are you sure to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
		</td>
		</tr>
		<?php endforeach;?>
	</table>
	
</div>
