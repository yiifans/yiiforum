<?php
/**
 * @var yii\web\View $this
 */
$this->title = 'My Yii Forum';
?>
<div class="site-index">


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
       			
       			echo '<a class="btn btn-success" href="/yiiforum/frontend/web/index.php?r=upgrade/do">升级</a>';
       		}
       ?>
    </div>
</div>
