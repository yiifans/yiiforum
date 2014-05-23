<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Board $model
 */

$this->title = 'Update Board: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Boards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="board-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'boardArrayTree' => $boardArrayTree,
    ]) ?>

</div>
