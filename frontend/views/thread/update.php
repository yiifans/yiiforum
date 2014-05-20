<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Thread $model
 */

$this->title = 'Update Thread: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Threads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="thread-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'body' => $body,
    ]) ?>

</div>
