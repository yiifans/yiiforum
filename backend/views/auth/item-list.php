<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\AuthItemSearch $searchModel
 */

$this->title = 'Auth Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index">

   

    <p>
    	
        <?= Html::a($type==1?'添加角色':'添加权限', ['create-item','type'=>$type], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
	    <tr class="tb_header">
	      
	      <th>标题</th>
	      
	      <th width="80">do</th>
	    </tr>
		<?php foreach ($items as $row ): ?>
		<tr>
		
		<td><?php echo $row->name?></td>
		
		<td>
			<a href="index.php?r=auth/update-item&id=<?php echo $row->name?>"><span class="glyphicon glyphicon-pencil"></span></a>
			<a href="index.php?r=auth/delete-item&id=<?php echo $row->name?>" data-confirm="Are you sure to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
		</td>
		</tr>
		<?php endforeach;?>
	</table>
</div>
