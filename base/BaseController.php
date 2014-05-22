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
use yii\data\Pagination;
use common\models\Board;

/**
 * Site controller
 */
class BaseController extends Controller
{


	public function getBoard($id)
	{
		return Board::findOne(['id'=>$id]);
	}
	
	public function getPagedRows($query,$config=[])
	{
		$countQuery = clone $query;
		$pages=new Pagination(['totalCount' => $countQuery->count()]);
		if(isset($config['pageSize']))
		{
			$pages->setPageSize($config['pageSize'],true);
		}
		
		$rows = $query->offset($pages->offset)->limit($pages->limit);
		if(isset($config['order']))
		{
			$rows = $rows->orderBy($config['order']);
		}
		$rows = $rows->all();
		
		
		$rowsLable='rows';
		$pagesLable='pages';
		
		if(isset($config['rows']))
		{
			$rowsLable=$config['rows'];
		}
		if(isset($config['pages']))
		{
			$pagesLable=$config['pages'];
		}
		
		$ret=[];
		$ret[$rowsLable]=$rows;
		$ret[$pagesLable]=$pages;
		
		return $ret;
	}
	
	public function execute($sql)
	{
		//Yii::info($sql,__METHOD__);
		$db=\Yii::$app->db;
		$command=$db->createCommand($sql);
		$command->execute();
	}
	
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
		date_default_timezone_set('PRC');
		return date('Y-m-d H:i:s',time());
	}
}
