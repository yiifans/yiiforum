<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\AuthItem $model
 */
$this->title='添加权限';

$this->params['breadcrumbs'][] = ['label' => '权限管理', 'url' => ['index','category'=>$currentCategory]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'categories' => $categories,
    ]) ?>

</div>
