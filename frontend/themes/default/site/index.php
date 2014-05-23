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
   				$parentBoard = $this->cachedBoards[$id];
   				$totalRecords=count($subBoards);
   				
   				$tdWidth='';
   				$columnsCount=intval($parentBoard['columns']);
   				if($columnsCount>1)
   				{
   					$tdWidth=(100.0/$columnsCount);
   					$tdWidth=' width ="'.$tdWidth.'%"';  					
   					
   					$rowsCount=ceil($totalRecords/$columnsCount);
   				}
   				else 
   				{
   					$columnsCount=1;
   					$rowsCount=$totalRecords;
   				}
   				
   				$html='<div class="tbox border">';
   				$html.='<div class="hd" style="border-bottom:none;"><h2>'.$parentBoard['name'].'</h2></div>';
   				
   				$html.='<table class="table" style="margin-bottom:0px;">';
   				$counter=0;
   				for($i=0;$i<$rowsCount;$i++)
   				{
   					$html.='<tr>';
   					for($j=0;$j<$columnsCount;$j++)
   					{
   						if($counter<$totalRecords)
   						{
   							$subBoard=$subBoards[$counter];
   								
   							$href=$this->homeUrl.'?r=thread/index&boardid='.$subBoard['id'];
   							$target='_self';
   						
   							if(!empty($subBoard['redirect_url']))
   							{
   								$href=$subBoard['redirect_url'];
   								$target=$subBoard['target'];
   								
   								$ddData='<dd>外部链接</dd>';
   							}
   							else 
   							{
   								$ddData = '<dd>主题：'.$subBoard['threads'].'&nbsp;回帖：'.$subBoard['posts'].'<dd>';
   								$ddData.= '<dd>最后发表：2014-05-23</dd>';
   							}
   							  							
   							$dtData = '<dt><a href="'.$href.'" target="'.$target.'">'.$subBoard['name'].'</a><dt>';  							
   						}
   						else 
   						{
   							$dtData='<dt>&nbsp;</dt>';
   							$ddData='<dd>&nbsp;</dd>';
   						}
   						$dl='<dl style="margin-bottom:0px;">'.$dtData.$ddData.'</dl>';
   						
   						$html.='<td'.$tdWidth.'>'.$dl.'</td>';
   						
   						$counter+=1;
   					}
   					$html.='</tr>';
   				}
   				
   				$html.='</table>';
   				//$html.='</div>';
   				$html.='</div>';
   				echo $html;
   			}
       	?>

    </div>
</div>
