<?php
use yii\helpers\Html;
/**
 * @var yii\web\View $this
 */
$this->title = '脚本升级';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

	<h1><?= $this->title ?></h1>

   

    <div class="body-content">
    
       <?php 
       		if(empty($needUpgradeSqls))
       		{
       			echo '不需要升级sql<br>';
       			echo '<a href="'.$this->homeUrl.'">返回首页</a>';
       		}
       		else 
       		{
       			echo '上次升级到的sql为：'.$lastSql.'<br>';
       			
       			echo '需要升级以下sql文件：(升级之前强烈建议你备份数据库)<br>';
       			foreach ($needUpgradeSqls as $sql)
       			{
       				echo '<font color="red">'.$sql.'</font><br>';
       			}
       			echo Html::a('升级', ['upgrade/do'], ['class' => 'btn btn-primary']);
       			
       		}
       ?>
    </div>
</div>
