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
	
	
}
