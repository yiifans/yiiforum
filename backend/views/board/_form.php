<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Board $model
 * @var yii\widgets\ActiveForm $form
 */

function getPrefix($count)
{
	$ret='';
	for($i=0;$i<$count;$i++)
	{
		$ret.='&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	return $ret;
}

$options='<option value="0">root</option>';
foreach ($boardArrayTree as $row)
{
	$selected='';
	if($model->parent_id==intval($row['id']))
	{
		$selected=' selected';
	}
	$style='';
	

	$options.='<option value="'.$row['id'].'"'.$selected.$style.'>'.getPrefix($row['level']).$row['name'].'</option>';
}

?>

<div class="board-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group field-board-parent_id required">
		<label class="control-label" for="board-parent_id">父级</label>
		<select id="board-parent_id" class="form-control" name="Board[parent_id]">
			<?php echo $options ?>
		</select>
		<div class="help-block"></div>
	</div>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 128]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
