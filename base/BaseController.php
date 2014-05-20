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
use yii\helpers\VarDumper;

/**
 * Site controller
 */
class BaseController extends Controller
{
	public function hasGetValue($key)
	{
		return isset($_GET[$key]);
	}
	public function getGetValue($key,$default=NULL)
	{
		if($this->hasGetValue($key))
		{
			return $_GET[$key];
		}
		return $default;
	}
	
	public function hasPostValue($key)
	{
		return isset($_POST[$key]);
	}
	
	public function getPostValue($key,$default=NULL)
	{
		if($this->hasPostValue($key))
		{
			return $_POST[$key];
		}
		return $default;
	}
	
	public function info($var,$category = 'application')
	{
		$dump=VarDumper::dumpAsString($var);
		Yii::info($category.$dump,$category);
	}
	
	public function setViewParam($array)
	{
		$view=$this->getView();
		foreach ($array as $name=>$value)
		{
			$view->params[$name] =$value;
		}
	}
	public function getViewParam($key,$defaultValue=null)
	{
		$view = $this->getView();
		if(isset($view->params[$key]))
		{
			return $view->params[$key];
		}
		return $defaultValue;
	}
	
	public function getCurrentTime()
	{
		return date('Y-m-d H:i:s',time());
	}
}
