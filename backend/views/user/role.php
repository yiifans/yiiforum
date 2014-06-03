<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var common\models\AuthItem $model
 */
$this->title='设定角色';

$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <?php
    	$existRoles = array_keys($existRoles);
    	foreach ($allRoles as $group=>$roles):?>
	    <div class="tbox">
	    	<div class="hd"><?php echo $group?></div>
	    	<?php 
			    echo Html::checkboxList('selectedRoles',$existRoles,ArrayHelper::map($roles, 'name', 'description'));
			?>
	    </div>
    <?php endforeach;?>
    
 

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary','name'=>'submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
