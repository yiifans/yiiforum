<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Thread $model
 */

$this->title = 'Create Thread';
$this->params['breadcrumbs'][] = ['label' => $currentBoard['name'], 'url' => ['index&boardid='.$currentBoard['id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thread-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'body' => $body,
    	'currentBoard' => $currentBoard,
    ]) ?>

</div>
