<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\BoardSearch $searchModel
 */

$this->title = 'Boards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="board-index">

    <p>
        <?= Html::a('新建', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('刷新缓存', ['refresh'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
	    <tr class="tb_header">
	      <th width="40px"> ID</th>
	      <th>标题</th>
	      <th width="60px"></th>
	      <th width="80">do</th>
	    </tr>
		<?php foreach ($boardArrayTree as $row ): ?>
		<tr>
		<td><?php echo $row['id']?></td>
		
		<td>
			<?php 
				for($i=0;$i<$row['level'];$i++)
				{
					echo '&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				echo $row['name'];
			?>
		</td>
		<td><?php echo $row['level']?></td>
		<td>
			<a href="index.php?r=board/view&id=<?php echo $row['id']?>"><span class="glyphicon glyphicon-eye-open"></span></a>
			<a href="index.php?r=board/update&id=<?php echo $row['id']?>"><span class="glyphicon glyphicon-pencil"></span></a>
			<a href="index.php?r=board/delete&id=<?php echo $row['id']?>" data-confirm="Are you sure to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
		</td>
		</tr>
		<?php endforeach;?>
	</table>


</div>
