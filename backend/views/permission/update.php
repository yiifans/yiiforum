<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\AuthItem $model
 */

$this->title = '修改权限: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '权限管理', 'url' => ['index','category'=>$currentCategory]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="auth-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'categories' => $categories,
    ]) ?>

</div>
