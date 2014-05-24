<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Post $model
 */

$this->title = 'Create Post';
$this->addBreadcrumb('Posts',['index']);
$this->addBreadcrumb($this->title);

?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
