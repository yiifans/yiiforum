<?php
namespace base;

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

/**
 * Site controller
 */
class BaseView extends View
{
	private $_cachedBoards;
	public function getCachedBoards()
	{
		if($this->_cachedBoards==null)
		{
			$this->_cachedBoards=YiiForum::getAppParam('cachedBoards');
		}
		return $this->_cachedBoards;
	}
	
	public function addBreadcrumb()
	{
		$argsCount = func_num_args();
		$args = func_get_args();
		
		if($argsCount == 1)
		{
			$this->params['breadcrumbs'][]=$args[0];
		}
		else if($argsCount == 2)
		{
			$this->params['breadcrumbs'][] = ['label' => $args[0], 'url' => $args[1]];
		}
	}
	
}
