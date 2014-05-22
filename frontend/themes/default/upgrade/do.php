<?php
/**
 * @var yii\web\View $this
 */
$this->title = 'My Yii Forum';
?>
<div class="site-index">


    <div class="body-content">
    
       <?php 
       		echo $message.'<br>';
       		
       		echo '<a href="'.$this->homeUrl.'">返回首页</a>';
       ?>
       
    </div>
</div>
