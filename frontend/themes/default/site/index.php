<?php
/**
 * @var yii\web\View $this
 */
$this->title = 'My Yii Forum';
?>
<div class="site-index">

    <div class="body-content">
    	
       	<?php 
   			foreach ($boards as $id=>$subBoards)
   			{
   				$html='<table class="table">';
   				$html.='<tr><th>'.$id.'</th></tr>';
   				foreach ($subBoards as $subBoard)
   				{
   					$href=$this->homeUrl.'?r=thread/index&boardid='.$subBoard['id'];
   					$html.='<tr><td><a href="'.$href.'">'.$subBoard['name'].'</a></td></tr>';
   				}
   				$html.='</table>';
   				echo $html;
   			}
       	?>

    </div>
</div>
