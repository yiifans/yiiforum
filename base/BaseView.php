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
			$this->_cachedBoards=$this->getParam('cachedBoards');
		}
		return $this->_cachedBoards;
	}
	
	public function getParam($key,$defaultValue=null)
	{
		$params = \Yii::$app->params;
		if(isset($params[$key]))
		{
			return $params[$key];
		}
		return $defaultValue;
	}
	
	public function setParam($array)
	{
		foreach ($array as $key=>$value)
		{
			\Yii::$app->params[$key]=$value;
		}
	}
	
	public function getHomeUrl($url=null)
	{
		$homeUrl = \Yii::$app->getHomeUrl();
		if($url!==null)
		{
			$homeUrl.=$url;
		}
		return $homeUrl;
	}
	
	public function getViewParam($key,$defaultValue=null)
	{
		$params=$this->params;
		if(isset($params[$key]))
		{
			return $params[$key];
		}
		return $defaultValue;
	}
	public function setViewParam($array)
	{
		$params=$this->params;
		foreach ($array as $name=>$value)
		{
			$params[$name]=$value;
		}
	}
	
	public function showTime($time,$format='Y-m-d')
	{
		echo date($format,strtotime($time));
	}
}
