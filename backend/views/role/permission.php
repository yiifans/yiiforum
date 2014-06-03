<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var common\models\AuthItem $model
 */
$this->title='设定权限:'.$model->description;

$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

   
    
    <?php $form = ActiveForm::begin();?>
    
    <?php foreach ($allPermissions as $category=>$permissions):?>
	    <div class="tbox">
	    	<div class="hd"><?php echo $category?></div>
	    	<?php 
			    echo Html::checkboxList('selectedPermissions',$existPermissions,ArrayHelper::map($permissions, 'name', 'description'));
			?>
	    </div>
    <?php endforeach;?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','name'=>'submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
