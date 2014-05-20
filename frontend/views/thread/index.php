<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\ThreadSearch $searchModel
 */

$this->title = 'Threads';
$this->params['breadcrumbs'][] = ['label' => $currentBoard['name'], 'url' => ['index&boardid='.$currentBoard['id']]];
?>
<div class="thread-index">


    <p>
        <?= Html::a('Create Thread', ['create&boardid='.$currentBoard['id']], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
    	<tr>
    		<th>title</th>
    		<th width="120px">posts/views</th>
    		<th width="150px">create time</th>
    		<th width="120px">user name</th>
    	</tr>
    	<?php foreach ($threads as $row ):?>
    	<tr>
    		<td><a href="<?php echo $this->homeUrl.'?r=thread/view&id='.$row['id']?>"><?php echo $row['title'];?></a></td>
    		<td><?php echo $row['posts'];?>/<?php echo $row['views']?></td>
    		<td><?php echo $row['create_time'];?></td>
    		<td><?php echo $row['user_name'];?></td>
    	</tr>
    	<?php endforeach;?>
    </table>
   

</div>
