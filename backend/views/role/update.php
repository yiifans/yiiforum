<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\AuthItem $model
 */

$this->title = '修改角色: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index','group'=>$currentGroup]];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="auth-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'groups' => $groups,
    ]) ?>

</div>
