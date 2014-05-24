<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\BoardSearch $searchModel
 */

$this->title = 'Boards';
$this->buildBreadcrumbs($currentBoard['id']);
?>
<div class="board-index">

    <?php echo $boards?>

</div>
