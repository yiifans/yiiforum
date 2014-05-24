<?php
namespace frontend\base;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use base\BaseController;
use common\models\Board;
use base\YiiForum;

/**
 * Site controller
 */
class BaseFrontController extends BaseController
{
    private function getBoardIcon($href,$target,$name)
    {
    	$src=YiiForum::getWebUrl().'/images/forum.gif';
    	$html='<div class="floatl"><a href="'.$href.'" target="'.$target.'"><img src="'.$src.'" alt="'.$name.'"/></a></div>';
    	return $html;
    }
    
	private function getOneColumn($subBoards,$rowsCount)
	{
		$html = '';
		$counter = 0;
		for($i = 0; $i < $rowsCount; $i++)
		{
			$html .= '<tr>';
			
			$subBoard=$subBoards[$counter];
				
			if(!empty($subBoard['redirect_url']))
			{
				$href=$subBoard['redirect_url'];
				$target=$subBoard['target'];
			
				$description='';
			
				$td2 = '&nbsp;';
				$td3 = '外部链接';
			}
			else
			{
				$href=YiiForum::getHomeUrl().'?r=thread/index&boardid='.$subBoard['id'];
				$target='_self';
			
				$description=$subBoard['description'];
			
				$td2 = $subBoard['threads'].'/'.$subBoard['posts'].'';
				if(!empty($subBoard['thread_title']))
				{
					$td3 ='<a href="'.YiiForum::getHomeUrl().'?r=thread/view&id='.$subBoard['thread_id'].'"/>'.$subBoard['thread_title'].'</a>';
					$td3.= '<br>最后发表：'.$subBoard['modify_time'];
				}
				else 
				{
					$td3='';
				}
			}
				
			$a = '<a href="'.$href.'" target="'.$target.'">'.$subBoard['name'].'</a>';
				
			$html.='<td class="boardinfo" style="vertical-align:middle;">';
			$html.=$this->getBoardIcon($href,$target,$subBoard['name']);
			$html.='<dl style="margin-bottom:0px;">';
			$html.='<dt>'.$a.'</dt>';
			if(!empty($description))
			{
				$html.='<dd>'.$description.'</dd>';
			}
			$html.='</dl>';
			$html.='</td>';
			$html.='<td style="vertical-align:middle;width:150px;">'.$td2.'</td>';
			$html.='<td class="smallFont" style="vertical-align:middle;width:220px;">'.$td3.'</td>';
			
			$counter+=1;
			
			$html.='</tr>';
		}
		
		return $html;
	}
	
	private function getMoreColumn($subBoards,$totalRecords,$columnsCount)
	{
		$html = '';
		
		$tdWidth=' width ="'.(100.0/$columnsCount).'%"';
		$rowsCount=ceil($totalRecords/$columnsCount);
		$counter=0;
		for($i=0; $i < $rowsCount; $i++)
		{
			$html.='<tr>';
			
			for($j=0; $j < $columnsCount; $j++)
			{
				$showIcon=true;
				if($counter < $totalRecords)
				{
					$subBoard = $subBoards[$counter];
				
					if(!empty($subBoard['redirect_url']))
					{
						$href=$subBoard['redirect_url'];
						$target=$subBoard['target'];
							
						$dd1='外部链接';
						$dd2='&nbsp;';
					}
					else
					{
						$href = YiiForum::getHomeUrl().'?r=thread/index&boardid='.$subBoard['id'];
						$target = '_self';
							
						$dd1 = '主题：'.$subBoard['threads'].'&nbsp;回帖：'.$subBoard['posts'].'';
						$dd2 = '最后发表：'.$subBoard['modify_time'];
					}
				
					$a = '<a href="'.$href.'" target="'.$target.'">'.$subBoard['name'].'</a>';
				}
				else
				{
					$showIcon=false;
					$a='&nbsp;';
					$dd1='&nbsp;';
					$dd2='&nbsp;';
				}
					
				$html.='<td class="boardinfo"'.$tdWidth.'>';
				if($showIcon)
				{
					$html.=$this->getBoardIcon($href,$target,$subBoard['name']);
				}
				$html.='<dl style="margin-bottom:0px;">';
				$html.='<dt>'.$a.'</dt>';
				$html.='<dd>'.$dd1.'</dd>';
				$html.='<dd>'.$dd2.'</dd>';
				$html.='</dl>';
				$html.='</td>';
				
				$counter+=1;
			}
			$html.='</tr>';
		}
		
		return $html;
	}
	
	public function buildBoards($boardId=0)
	{
		$html = '';
		
		$boards=Board::findAll(['parent_id'=>$boardId],'sort_num desc');
		foreach ($boards as $board)
		{
			$id = $board['id'];
			$subBoards=Board::findAll(['parent_id'=>$id],'sort_num desc');
			if(count($subBoards) == 0)
			{
				continue;
			}
			
			$parentBoard = $this->getCachedBoards()[$id];
			$totalRecords=count($subBoards);		
		
			$columnsCount=intval($parentBoard['columns']);
			
			$html.='<div class="tbox border">';
			$html.='<div class="hd" style="border-bottom:none;"><h2><a href="'.YiiForum::getHomeUrl().'?r=board/index&boardid='.$id.'">'.$parentBoard['name'].'</a></h2></div>';
		
			$html.='<table class="table" style="margin-bottom:0px;">';
			if($columnsCount>1)
			{
				$html.=$this->getMoreColumn($subBoards, $totalRecords, $columnsCount);
			}
			else 
			{
				$html.=$this->getOneColumn($subBoards, $totalRecords);
			}
			$html.='</table>';
			$html.='</div>';
		}
		return $html;
	}
	
	
	public function buildSubBoards($id=0,$parentName='子板块')
	{
		$subBoards=Board::findAll(['parent_id'=>$id],'sort_num desc');
			
		$totalRecords=count($subBoards);
		if($totalRecords == 0)
		{
			return ;
		}
		
		$html = '';
	
		$parentBoard = $this->getCachedBoards()[$id];
		
		$columnsCount=intval($parentBoard['columns']);
		
		if($parentName==null)
		{
			$parentName = $parentBoard['name'];
		}
		
		$html.='<div class="tbox border">';
		$html.='<div class="hd" style="border-bottom:none;"><h2>'.$parentName.'</h2></div>';

		$html.='<table class="table" style="margin-bottom:0px;">';
		if($columnsCount>1)
		{
			$html.=$this->getMoreColumn($subBoards, $totalRecords, $columnsCount);
		}
		else
		{
			$html.=$this->getOneColumn($subBoards, $totalRecords);
		}
		$html.='</table>';
		$html.='</div>';
		
		return $html;
	}
}
