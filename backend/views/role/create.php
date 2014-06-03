<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\AuthItem $model
 */
$this->title='添加角色';

$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index','group'=>$currentGroup]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'groups' => $groups,
    ]) ?>

</div>
