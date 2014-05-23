<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Board $model
 */

$this->title = '新建';
$this->params['breadcrumbs'][] = ['label' => 'Boards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="board-create">

    <?= $this->render('_form', [
        'model' => $model,
    	'boardArrayTree' => $boardArrayTree,
    ]) ?>

</div>
