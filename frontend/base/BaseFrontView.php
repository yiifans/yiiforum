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
use yii\web\View;
use base\BaseView;

/**
 * Site controller
 */
class BaseFrontView extends BaseView
{

	public function buildBreadcrumbs($bondId)
	{
		if(!isset($this->params['breadcrumbs']))
		{
			$this->params['breadcrumbs']=[];
		}
		
		
		$cachedBoards=$this->getCachedBoards();
		$board=$cachedBoards[$bondId];
		while (($parentId = $board['parent_id'])!=0)
		{
			$breadcrumbs= ['label' => $board['name'], 'url' => ['index&boardid='.$board['id']]];
			
			array_unshift($this->params['breadcrumbs'],$breadcrumbs);
			//$this->params['breadcrumbs'][] = ['label' => $board['name'], 'url' => ['index&boardid='.$board['id']]];
			
			$board = $cachedBoards[$parentId];
		}
		
		$breadcrumbs= ['label' => $board['name'], 'url' => ['board/index&boardid='.$board['id']]];
			
		array_unshift($this->params['breadcrumbs'],$breadcrumbs);
	}
}
