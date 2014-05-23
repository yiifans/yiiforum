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
   					if($columnsCount>1)
   					{
	   					for($j=0;$j<$columnsCount;$j++)
	   					{
	   						if($counter < $totalRecords)
	   						{
	   							$subBoard=$subBoards[$counter];
	   								
	   							if(!empty($subBoard['redirect_url']))
	   							{
	   								$href=$subBoard['redirect_url'];
	   								$target=$subBoard['target'];
	   								
	   								$dd1='外部链接';
	   								$dd2='&nbsp;';
	   							}
	   							else 
	   							{
	   								$href=$this->homeUrl.'?r=thread/index&boardid='.$subBoard['id'];
	   								$target='_self';
	   								
	   								$dd1 = '主题：'.$subBoard['threads'].'&nbsp;回帖：'.$subBoard['posts'].'';
	   								$dd2= '最后发表：2014-05-23';
	   							}
	   							  							
	   							$a = '<a href="'.$href.'" target="'.$target.'">'.$subBoard['name'].'</a>';  							
	   						}
	   						else 
	   						{
	   							$a='&nbsp;';
	   							$dd1='&nbsp;';
	   							$dd2='&nbsp;';
	   						}
	   					
	   						
	   						$html.='<td'.$tdWidth.'>';
	   						$html.='<dl style="margin-bottom:0px;">';
	   						$html.='<dt>'.$a.'</dt>';
	   						$html.='<dd>'.$dd1.'</dd>';
	   						$html.='<dd>'.$dd2.'</dd>';
	   						$html.='</dl>';
	   						$html.='</td>';
	   							
	   						$counter+=1;
	   					}
   					}
   					else 
   					{
   						$subBoard=$subBoards[$counter];
   						
   						if(!empty($subBoard['redirect_url']))
   						{
   							$href=$subBoard['redirect_url'];
   							$target=$subBoard['target'];
   						
   							$description='&nbsp;';
   							
   							$td2 = '&nbsp;';
   							$td3 = '外部链接';
   						}
   						else
   						{
   							$href=$this->homeUrl.'?r=thread/index&boardid='.$subBoard['id'];
   							$target='_self';
   						
   							$description='<p style="margin:0px;">'.$subBoard['description'].'</p>';
   							
   							$td2 = $subBoard['threads'].'/'.$subBoard['posts'].'';
   							$td3 = '最后发表：2014-05-23';
   						}
   						
   						$a = '<a href="'.$href.'" target="'.$target.'">'.$subBoard['name'].'</a>';
   						
   						$html.='<td style="vertical-align:middle;">'.$a.$description.'</td>';
   						$html.='<td style="vertical-align:middle;width:150px;">'.$td2.'</td>';
   						$html.='<td style="vertical-align:middle;width:220px;">'.$td3.'</td>';
   						
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
