<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var common\models\AuthItem $model
 */
$this->title='设定权限:';

$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <div class="tbox">
    	<div class="hd">设定角色：</div>
    	<?php 
		    
		    $existItems=array_keys($existItems);
		    echo Html::checkboxList('selectedRoles',$existItems,ArrayHelper::map($allRoles, 'name', 'name'));
		    ?>
    
    </div>
    <div class="tbox">
    	<div class="hd">设定权限：</div>
    	<?php 
		    echo Html::checkboxList('selectedPermissions',$existItems,ArrayHelper::map($allPermissions, 'name', 'name'));
		    ?>
    </div>
    
  

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary','name'=>'submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
