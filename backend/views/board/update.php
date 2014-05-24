<?php

use yii\helpers\Html;
use base\YiiForum;

/**
 * @var yii\web\View $this
 * @var common\models\Board $model
 */

$this->title = 'Update Board: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Boards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$messageArray[1]='<font color="red">父结点不能为当前结点的子结点</font>';
?>
<div class="board-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 
    
    
    	$message=YiiForum::getGetValue('message',0);
    	if($message==1)
    	{
    		echo $messageArray[$message].'<br>';
    	}
    	
    ?>
    <?= $this->render('_form', [
        'model' => $model,
    	'boardArrayTree' => $boardArrayTree,
    	
    ]) ?>

</div>
